@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Tambah Produk</h2>
  <form method="POST" action="/admin/products" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Nama Produk</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Harga</label>
      <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Gambar</label>
      <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/admin" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
