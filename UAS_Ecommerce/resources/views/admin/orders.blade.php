@extends('layouts.app')

@section('content')
<h3>Daftar Pesanan User</h3>

@foreach($orders as $order)
    <div class="card mb-3">
        <div class="card-header">
            Order #{{ $order->id }} - {{ $order->user->name ?? 'User tidak ditemukan' }}<br>
            Total: Rp{{ number_format($order->total, 0, ',', '.') }}
        </div>
        <ul class="list-group list-group-flush">
            @foreach($order->items as $item)
                <li class="list-group-item">
                    {{ $item->product_name ?? 'Produk tidak ditemukan' }} - 
                    {{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}
                </li>
            @endforeach
        </ul>
    </div>
@endforeach
<a href="/" class="btn btn-outline-primary mb-3">Kembali ke Halaman Utama</a>
@endsection
