@extends('layouts.app')
@section('content')
<h2>Keranjang Belanja</h2>
@if (count($cart) === 0)
  <p>Keranjang kosong.</p>
@else
  <table class="table">
    <thead>
      <tr><th>Nama</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr>
    </thead>
    <tbody>
      @php $total = 0; @endphp
      @foreach ($cart as $code => $item)
        @php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; @endphp
        <tr>
          <td>{{ $item['name'] }}</td>
          <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
          <td>{{ $item['qty'] }}</td>
          <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr><td colspan="3"><strong>Total</strong></td><td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td></tr>
    </tfoot>
  </table>
  <form method="POST" action="/cart/checkout">
    @csrf
    <button class="btn btn-success">Checkout</button>
  </form>
@endif
@endsection