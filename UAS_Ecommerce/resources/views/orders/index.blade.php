@extends('layouts.app')

@section('content')
<h3>Daftar Pesanan</h3>
@if($orders->isEmpty())
    <div class="alert alert-info">Belum ada pesanan.</div>
    <a href="/" class="btn btn-secondary">Kembali ke Halaman Utama</a>
@else
    @foreach($orders as $order)
        <div class="card mb-3">
            <div class="card-header">
                Order #{{ $order->id }} - Total: Rp{{ number_format($order->total, 0, ',', '.') }}
            </div>
            <ul class="list-group list-group-flush">
                @foreach($order->items as $item)
                <li class="list-group-item">
                    {{ $item->product_name ?? 'Produk tidak tersedia' }} - {{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}
                </li>
                @endforeach
            </ul>
        </div>
    @endforeach
    <a href="/" class="btn btn-secondary mt-4">Kembali ke Halaman Utama</a>
@endif
@endsection

