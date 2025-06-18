@extends('layouts.app')
@section('content')
<h2 class="mb-4">Dashboard Admin</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
  <a href="/admin/orders" class="btn btn-success">Lihat Pesanan</a>
  <a href="/admin/products/create" class="btn btn-primary">Tambah Produk</a>
</div>

<table class="table">
  <thead>
    <tr>
      <th>Kode Produk</th>
      <th>Nama</th>
      <th>Harga</th>
      <th>Deskripsi</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $p)
      <tr>
        <td>{{ $p->product_code }}</td>
        <td>{{ $p->name }}</td>
        <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
        <td>{{ $p->description }}</td>
        <td>
          @if ($p->image)
            <img src="{{ asset('storage/' . $p->image) }}" width="60">
          @else
            -
          @endif
        </td>
        <td>
          <a href="/admin/products/{{ $p->product_code }}/edit" class="btn btn-sm btn-warning mb-1">Edit</a>
          <form method="POST" action="/admin/products/{{ $p->product_code }}" style="display:inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
