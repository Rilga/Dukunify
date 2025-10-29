<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Dukun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request, Dukun $dukun)
    {
        $user = Auth::user();

        $activeBookingsCount = $user->bookings()->where('status', 'aktif')->count();
        $cartItemsCount = $user->carts()->count();

        if (($activeBookingsCount + $cartItemsCount) >= 2) {
            return redirect()->back()->with('error', 'Gagal! Anda hanya dapat menyewa maksimal 2 unit (termasuk di keranjang).');
        }

        $existingCartItem = $user->carts()->where('dukun_id', $dukun->id)->first();
        if ($existingCartItem) {
            return redirect()->back()->with('error', 'Dukun ini sudah ada di keranjang Anda.');
        }

        $user->carts()->create([
            'dukun_id' => $dukun->id,
        ]);

        return redirect()->route('cart.index')->with('success', 'Dukun berhasil ditambahkan ke keranjang.');
    }

    public function index()
    {
        $cartItems = Auth::user()->carts()->with('dukun')->get();

        $totalHarga = $cartItems->sum(function($item) {
            return $item->dukun->harga;
        });

        return view('cart.index', compact('cartItems', 'totalHarga'));
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

}