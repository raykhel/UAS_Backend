@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Daftar Produk</h2>
  <div class="row">
    @foreach ($products as $product)
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text text-muted">Kode: {{ $product->product_code }}</p>
            <p class="card-text"><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
            <p class="card-text">{{ $product->description }}</p>
          </div>
          <div class="card-footer">
            <form method="POST" action="{{ url('/cart/add/' . $product->product_code) }}">
              @csrf
              <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
