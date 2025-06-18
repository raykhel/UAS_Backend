<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

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
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang kosong');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
        ]);

        foreach ($cart as $code => $item) {
            $product = Product::where('product_code', $code)->first();

            if (!$product) {
                continue;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $item['price'],
                'quantity' => $item['qty'],
            ]);
        }

        session()->forget('cart');

        return redirect('/orders')->with('success', 'Checkout berhasil!');
    }
}
