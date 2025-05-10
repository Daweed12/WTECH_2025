<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use App\Models\DeliveryMethod;
use App\Models\Order;


class CartController extends Controller
{
    /**
     * Retrieve the current cart for session or authenticated user.
     */
    public function getCart(): Cart
    {
        // 1) Ak som prihlásený, najprv hľadaj existujúci cart pre usera
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                ->where('status', 'active')
                ->first();

            // 1a) Ak žiadny neexistuje, pozri sa či v session nemáš
            //     guest-cart a priraď ho k userovi
            if (! $cart && session('cart_id')) {
                $possible = Cart::where('id', session('cart_id'))
                    ->where('status', 'active')
                    ->first();
                if ($possible) {
                    $possible->update([
                        'user_id'    => Auth::id(),
                        'session_id' => null,
                    ]);
                    $cart = $possible;
                }
            }

            // 1b) Ak stále nič, vytvor nový
            if (! $cart) {
                $cart = Cart::create([
                    'user_id'    => Auth::id(),
                    'session_id' => null,
                    'token'      => Str::uuid(),
                    'status'     => 'active',
                ]);
            }

            // ulož do session, nech si ho getCart pamätá
            session(['cart_id' => $cart->id]);
            return $cart;
        }

        // 2) Nie som prihlásený → klasický “guest” podľa session_id
        $sessionId = session()->getId();
        $cart = Cart::where('session_id', $sessionId)
            ->where('status', 'active')
            ->first();

        if (! $cart) {
            $cart = Cart::create([
                'user_id'    => null,
                'session_id' => $sessionId,
                'token'      => Str::uuid(),
                'status'     => 'active',
            ]);
        }

        session(['cart_id' => $cart->id]);
        return $cart;
    }

    /**
     * Show cart preview with items and best sellers.
     */
    public function preview()
    {
        $cart = $this->getCart()
            ->load('items.product.images');  // eager-loading
        return view('cart.preview', compact('cart'));
    }

    public function update(Request $request, CartProduct $item)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->quantity = $data['quantity'];
        $item->save();

        return redirect()
            ->route('cart.preview')
            ->with('success', 'Množstvo položky bolo aktualizované.');
    }

    public function add(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();

        // Skontrolujeme, či už v košíku táto položka je
        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            // Ak áno, navýšime
            $item->quantity += $data['quantity'];
            $item->price     = $product->price; // aktualizujeme cenu, ak sa zmenila
            $item->save();
        } else {
            // Ak nie, vytvoríme novú položku
            $cart->items()->create([
                'product_id' => $product->id,
                'sku'        => $product->sku,               // <— doplnené
                'price'      => $product->price,
                'quantity'   => $data['quantity'],
                'discount'   => $product->discount ?? 0,     // ak máte v produkte discount
                'active'     => true,
            ]);
        }

        return redirect()
            ->route('cart.preview')
            ->with('success', 'Produkt bol pridaný do košíka.');
    }


    /**
     * Remove an item from the cart.
     */
    public function remove(CartProduct $item)
    {
        $item->delete();

        return redirect()
            ->route('cart.preview')
            ->with('success', 'Položka bola odstránená z košíka.');
    }

    /**
     * Save shipping address and optionally persist it to user.
     */
    public function showAddress()
    {
        $address = auth()->check() && session('address_id')
            ? Address::find(session('address_id'))
            : session('guest_address', []);

        $cart = $this->getCart();
        return view('cart.address', compact('address','cart'));
    }

    /**
     * Spracuje POST z Address Details (POST /cart/address).
     */
    public function saveAddress(Request $request)
    {
        $data = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'city'           => 'required|string|max:255',
            'zip'            => 'required|string|max:20',
            'country'        => 'required|string|max:255',
            'phone'          => 'required|string|max:50',
        ]);

        if (auth()->check()) {
            $address = Address::create($data);
            auth()->user()->addresses()->syncWithoutDetaching($address->id);
            session(['address_id' => $address->id]);
        } else {
            session(['guest_address' => $data]);
        }

        return redirect()->route('cart.payment.form');
    }

    public function showPayment()
    {
        $cart             = $this->getCart();
        $paymentMethods   = PaymentMethod::all();
        $deliveryMethods  = DeliveryMethod::all();

        $address = auth()->check() && session('address_id')
            ? Address::find(session('address_id'))
            : session('guest_address', null);

        return view('cart.pay_ship', compact(
            'cart','paymentMethods','deliveryMethods','address'
        ));
    }

    public function showThanks()
    {
        // Môžeš sem vkladať čokoľvek, napr. order_id zo session
        $orderId = session('order_id');

        return view('cart.thanks', compact('orderId'));
    }


    /**
     * Save chosen payment and delivery methods.
     */
    public function savePayment(Request $request)
    {
        $data = $request->validate([
            'delivery_method' => 'required|exists:delivery_methods,id',
            'payment_method'  => 'required|exists:payment_methods,id',
        ]);

        // Ak sme guest a máme uložené guest_address, vytvorím z neho Address v DB
        if (! auth()->check() && session()->has('guest_address')) {
            $guest = session('guest_address');

            // Vytvorím nový záznam v addresses (user_id zostane NULL)
            $address = Address::create($guest);

            // Uložím ID do session tak, aby sa použilo pri Order::create()
            session(['address_id' => $address->id]);

            // (Voliteľne) môžeme zmazať staré guest_address:
            session()->forget('guest_address');
        }


        // 1) Načítame košík
        $cart = $this->getCart();

        // 2) Vypočítame subtotal (produkty × množstvo)
        $subtotal = $cart->items->sum(function($item) {
            return $item->price * $item->quantity;
        });

        // 3) Načítame poplatky
        $deliveryMethod = DeliveryMethod::findOrFail($data['delivery_method']);
        $paymentMethod  = PaymentMethod::findOrFail($data['payment_method']);
        $deliveryFee    = $deliveryMethod->fee;
        $paymentFee     = $paymentMethod->fee;

        // 4) Spočítame CELKOVÚ sumu (subtotal + poplatky)
        $totalPrice = $subtotal + $deliveryFee + $paymentFee;

        // 5) Uložíme objednávku vrátane total_price
        $order = Order::create([
            'user_id'             => auth()->id(),
            'session_id'          => $cart->session_id,
            'address_id'          => session('address_id'),
            'delivery_method_id'  => $deliveryMethod->id,
            'payment_method_id'   => $paymentMethod->id,
            'total_price'         => $totalPrice,   // <— tu uložíme finálnu sumu
            'delivery_fee'        => $deliveryFee,
            'payment_fee'         => $paymentFee,
            'discount'            => 0,
            'status'              => 'pending',
        ]);

        // 6) Uložíme položky objednávky
        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'sku'        => $item->sku,
                'price'      => $item->price,
                'discount'   => $item->discount,
                'quantity'   => $item->quantity,
            ]);
        }

        // 7) Uložíme order_id do session a ideme na confirm
        session(['order_id' => $order->id]);

        return redirect()->route('cart.confirm');
    }



    /**
     * Show final order review before confirmation.
     */
    public function showConfirm()
    {
        $cart  = $this->getCart();
        $order = Order::with([
            'address',
            'deliveryMethod',
            'paymentMethod',
            'items.product'
        ])->findOrFail(session('order_id'));

        return view('cart.confirm', compact('cart', 'order'));
    }

    public function finalizeOrder(Request $request)
    {
        // 1) Načítať order a zmeniť status
        $order = Order::findOrFail(session('order_id'));
        $order->status = 'done';
        $order->save();

        // 2) Načítať a uzavrieť aktuálny košík
        $cart = $this->getCart();
        $cart->status = 'completed';    // alebo 'closed', 'ordered'…
        $cart->save();

        // 3) Odstrániť všetky položky z tohto košíka (alebo ich presunúť)
        //    Tu ideme zmazať všetko, čo je v košíku
        $cart->items()->delete();

        // 4) Odstrániť ID košíka zo session, aby bol “empthy”
        session()->forget('cart_id');

        // 5) Presmerovať na ďakovnú stránku
        return redirect()->route('order.thanks');
    }

}
