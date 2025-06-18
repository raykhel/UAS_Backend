<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

abstract class Controller
{
    //
    public function addToCart(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $qty = $request->input('qty', 1);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['qty'] += $qty;
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $qty,
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Produk ditambahkan ke keranjang!');
}

}
