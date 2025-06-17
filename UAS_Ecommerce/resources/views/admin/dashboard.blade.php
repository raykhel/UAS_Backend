@extends('layouts.app')
@section('content')
<h2 class="mb-4">Dashboard Admin</h2>
<a href="/admin/products/create" class="btn btn-primary mb-3">Tambah Produk</a>

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Kode Produk</th>
      <th>Nama</th>
      <th>Harga</th>
      <th>Deskripsi</th>
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
          <a href="/admin/products/{{ $p->product_code }}/edit" class="btn btn-sm btn-warning">Edit</a>
          <form method="POST" action="/admin/products/{{ $p->product_code }}" style="display:inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
