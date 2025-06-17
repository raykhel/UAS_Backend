@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Keranjang Belanja</h2>

  @if(count($cart) > 0)
    <table class="table">
      <thead>
        <tr>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @php $total = 0; @endphp
        @foreach($cart as $code => $item)
          @php
            $subtotal = $item['price'] * $item['qty'];
            $total += $subtotal;
          @endphp
          <tr>
            <td>{{ $item['name'] }}</td>
            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
            <td>{{ $item['qty'] }}</td>
            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="text-end">
      <h4>Total: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></h4>
      <form method="POST" action="/cart/checkout">
        @csrf
        <button class="btn btn-success mt-2">Checkout</button>
      </form>
    </div>
  @else
    <p>Keranjang masih kosong.</p>
  @endif
</div>
@endsection
