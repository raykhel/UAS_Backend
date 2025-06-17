@extends('layouts.app')
@section('content')
<h2 class="mb-4">Tambah Produk</h2>
<form method="POST" action="/admin/products">
  @csrf
  <div class="mb-3">
    <label>Nama Produk</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Harga</label>
    <input type="number" name="price" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control"></textarea>
  </div>
  <button class="btn btn-success">Simpan</button>
</form>
@endsection