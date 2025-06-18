@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Edit Produk</h2>
  <form method="POST" action="/admin/products/{{ $product->product_code }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="name" class="form-label">Nama Produk</label>
      <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Harga</label>
      <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Gambar Baru (opsional)</label>
      <input type="file" name="image" class="form-control">
      @if($product->image)
        <div class="mt-2">
          <p>Gambar saat ini:</p>
          <img src="{{ asset('storage/' . $product->image) }}" width="150">
        </div>
      @endif
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/admin" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
