<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Address;
use App\Models\PaymentMethod;
use App\Models\DeliveryMethod;
use Illuminate\Support\Str;


class CartController extends Controller
{
    /**
     * Retrieve the current cart for session or authenticated user.
     */
    protected function getCart(): Cart
    {
        // 1) Skúsim podľa session('cart_id')
        if ($id = session('cart_id')) {
            if ($cart = Cart::find($id)) {
                return $cart;
            }
        }

        // 2) Ak som prihlásený, hľadám (alebo vytvorím) košík pre usera
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id(), 'status' => 'active'],
                ['session_id' => null, 'token' => Str::uuid()]
            );
        } else {
            // 3) Inak guest – podľa session_id
            $sessionId = session()->getId();
            $cart = Cart::firstOrCreate(
                ['session_id' => $sessionId, 'status' => 'active'],
                ['user_id' => null, 'token' => Str::uuid()]
            );
        }

        // 4) Uložím ID do session
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
    public function saveAddress(Request $request)
    {
        $data = $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city'          => 'required|string|max:100',
            'postal_code'   => 'required|string|max:20',
            'country'       => 'required|string|max:100',
            'save_address'  => 'sometimes|boolean',
        ]);

        // Store or update address
        $address = Address::create([
            'user_id'       => Auth::id(),
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'] ?? null,
            'address_line1' => $data['address_line1'],
            'address_line2' => $data['address_line2'] ?? null,
            'city'          => $data['city'],
            'postal_code'   => $data['postal_code'],
            'country'       => $data['country'],
        ]);

        // Optionally save to user profile
        if ($request->boolean('save_address') && Auth::check()) {
            Auth::user()->addresses()->save($address);
        }

        // Save to session for order
        session([ 'cart.address_id' => $address->id ]);

        return redirect()->route('cart.payment');
    }

    /**
     * Save chosen payment and delivery methods.
     */
    public function savePayment(Request $request)
    {
        $data = $request->validate([
            'payment_method'  => 'required|exists:payment_methods,id',
            'delivery_method' => 'required|exists:delivery_methods,id',
        ]);

        session([
            'cart.payment_method_id'  => $data['payment_method'],
            'cart.delivery_method_id' => $data['delivery_method'],
        ]);

        return redirect()->route('cart.final');
    }

    /**
     * Show final order review before confirmation.
     */
    public function final()
    {
        $cart = $this->getCart();

        $address = Address::find(session('cart.address_id'));
        $paymentMethod = PaymentMethod::find(session('cart.payment_method_id'));
        $deliveryMethod = DeliveryMethod::find(session('cart.delivery_method_id'));

        return view('cart.final', compact(
            'cart', 'address', 'paymentMethod', 'deliveryMethod'
        ));
    }
}
