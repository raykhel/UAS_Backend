<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login sebelum checkout');
        }

        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total
        ]);

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                ]);
            }
        }

        

        session()->forget('cart');
        return redirect('/orders')->with('success', 'Checkout berhasil!');
    }
}
