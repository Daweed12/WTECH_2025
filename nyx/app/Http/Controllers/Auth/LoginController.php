<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Kam prepnúť užívateľa po loginu.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Tento hook sa vykoná po úspešnom prihlásení.
     */
    protected function authenticated(Request $request, $user)
    {
        // 1) Nájdi guest-cart podľa session_id
        $sessionId = $request->session()->getId();
        $guestCart = Cart::where('session_id', $sessionId)
            ->where('status', 'active')
            ->first();

        if (! $guestCart) {
            return;
        }

        // 2) Nájdi alebo vytvor aktívny user-cart
        $userCart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'active'],
            ['session_id' => null, 'token' => null]
        );

        // 3) Pre každú položku z guest-cart ju buď navýš, alebo vlož novú
        foreach ($guestCart->items as $item) {
            $existing = $userCart->items()
                ->where('product_id', $item->product_id)
                ->first();

            if ($existing) {
                $existing->quantity += $item->quantity;
                $existing->save();
            } else {
                $userCart->items()->create([
                    'product_id' => $item->product_id,
                    'sku'        => $item->sku,
                    'price'      => $item->price,
                    'discount'   => $item->discount,
                    'quantity'   => $item->quantity,
                    'active'     => $item->active,
                ]);
            }
        }

        // 4) Označ guest-cart ako zlúčený (alebo ho môžeš úplne zmazať)
        $guestCart->status = 'merged';
        $guestCart->save();

        // 5) Ulož user-cart do session, nech sa ďalej naň odkazujeme
        $request->session()->put('cart_id', $userCart->id);
    }
}
