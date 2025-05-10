<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\DeliveryMethod;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage, based on the current cart.
     */
    public function store(Request $request)
    {
        // Retrieve active cart
        $cartController = app(CartController::class);
        $cart = $cartController->getCart();

        // Ensure necessary session data exists
        $addressId = session('cart.address_id');
        $paymentMethodId = session('cart.payment_method_id');
        $deliveryMethodId = session('cart.delivery_method_id');

        if (! $addressId || ! $paymentMethodId || ! $deliveryMethodId) {
            return redirect()->route('cart.preview')
                ->withErrors('Incomplete order data. Please complete all steps.');
        }

        // Calculate totals
        $subtotal = $cart->subtotal();
        $paymentFee = PaymentMethod::findOrFail($paymentMethodId)->fee;
        $deliveryFee = DeliveryMethod::findOrFail($deliveryMethodId)->fee;
        $discount = session('discount', 0);
        $total = $subtotal + $paymentFee + $deliveryFee - $discount;

        // Create order
        $order = Order::create([
            'user_id'            => Auth::id(),
            'cart_id'            => $cart->id,
            'address_id'         => $addressId,
            'payment_method_id'  => $paymentMethodId,
            'delivery_method_id' => $deliveryMethodId,
            'status'             => 'pending',
            'subtotal'           => $subtotal,
            'payment_fee'        => $paymentFee,
            'delivery_fee'       => $deliveryFee,
            'discount'           => $discount,
            'total'              => $total,
        ]);

        // Transfer cart items into order products
        foreach ($cart->items as $item) {
            OrderProduct::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
                'options'    => $item->options,
            ]);
        }

        // Mark cart as completed
        $cart->status = 'completed';
        $cart->save();

        // Clear cart session data
        session()->forget([
            'cart.address_id',
            'cart.payment_method_id',
            'cart.delivery_method_id',
            'discount',
        ]);

        // Redirect to a success page
        return redirect()->route('order.success', ['order' => $order]);
    }
}
