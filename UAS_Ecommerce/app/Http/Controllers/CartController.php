<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $r, $product_code)
    {
        $product = Product::where('product_code', $product_code)->firstOrFail();

        $cart = session()->get('cart', []);
        $cart[$product_code] = [
            'name' => $product->name,
            'price' => $product->price,
            'qty' => ($cart[$product_code]['qty'] ?? 0) + 1,
        ];

        session()->put('cart', $cart);
        return redirect('/cart')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function index() {
        $cart = session('cart', []);
        $products = Product::whereIn('product_code', array_keys($cart))->get();
        return view('cart.index', compact('cart','products'));
    }

    public function checkout(Request $r)
    {
        session()->forget('cart');
        return redirect('/')->with('success', 'Checkout berhasil!');
    }
}
