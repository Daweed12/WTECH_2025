<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Cart;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Tento hook sa zavolá po úspešnom prihlásení.
     * Merge-uje položky z guest-košíka do user-košíka.
     */
    protected function authenticated(Request $request, $user)
    {
        // 1) nájdi guestCart podľa session_id
        $sessionId = $request->session()->getId();
        $guestCart = Cart::where('session_id', $sessionId)
            ->where('status', 'active')
            ->first();

        if (! $guestCart) {
            // žiadny guest-košík → nič sa nedeje
            return;
        }

        // 2) nájdi alebo vytvor už existujúci userCart
        $userCart = Cart::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (! $userCart) {
            // ak userCart ešte neexistuje, presuň guestCart a priraď ho userovi
            $guestCart->update([
                'user_id'    => $user->id,
                'session_id' => null,
            ]);
            session(['cart_id' => $guestCart->id]);
            return;
        }

        // 3) ak userCart existuje, mergeuj všetky položky
        foreach ($guestCart->items as $item) {
            $existing = $userCart->items()
                ->where('product_id', $item->product_id)
                ->first();
            if ($existing) {
                // navýš množstvo
                $existing->quantity += $item->quantity;
                $existing->save();
            } else {
                // vlož novú položku
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

        // 4) označ guestCart ako merged (alebo ho môžeš vymazať)
        $guestCart->update(['status' => 'merged']);

        // 5) ulož userCart id do session
        session(['cart_id' => $userCart->id]);
    }
}
