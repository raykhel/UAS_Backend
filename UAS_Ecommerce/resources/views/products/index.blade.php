@extends('layouts.app')
@section('content')
<h2 class="mb-4">Produk Tersedia</h2>
<div class="row">
  @foreach ($products as $product)
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        @if ($product->image)
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
        @else
          <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top">
        @endif
        <div class="card-body">
          <h5 class="card-title">{{ $product->name }}</h5>
          <p class="text-muted">Kode: {{ $product->product_code }}</p>
          <p><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
          <p>{{ $product->description }}</p>
        </div>
        <div class="card-footer">
          <form method="POST" action="/cart/add/{{ $product->product_code }}">
            @csrf
            <button class="btn btn-primary w-100">Tambah ke Keranjang</button>
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection