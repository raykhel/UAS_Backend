<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminController extends Controller
{
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
    }

    public function dashboard()
    {
        $this->authorizeAdmin();
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $data['image'] = 'images/' . $filename;
        }

        Product::create($data);
        return redirect('/admin')->with('success', 'Produk ditambahkan');
    }

    public function edit($product_code)
    {
        $this->authorizeAdmin();
        $product = Product::where('product_code', $product_code)->firstOrFail();
        return view('admin.edit', compact('product'));
    }

public function update(Request $request, $product_code)
    {
        $this->authorizeAdmin();
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product = Product::where('product_code', $product_code)->firstOrFail();

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $product->update($data);
        return redirect('/admin')->with('success', 'Produk diupdate');
    }

public function destroy($product_code)
    {
        $this->authorizeAdmin();
        $product = Product::where('product_code', $product_code)->firstOrFail();
        $product->delete();
        return redirect('/admin')->with('success', 'Produk dihapus');
    }

    public function editByCode($code)
    {
        $this->authorizeAdmin();
        $product = Product::where('product_code', $code)->firstOrFail();
        return view('admin.edit', compact('product'));
    }

}
