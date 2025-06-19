@extends('layouts.app')

@section('content')
<h2 class="mb-4">Keranjang Belanja</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(empty($cart))
    <div class="alert alert-info">
        Keranjang kosong.
    </div>
    <a href="/" class="btn btn-secondary">Kembali ke Halaman Utama</a>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $code => $item)
                <tr data-code="{{ $code }}">
                    <td>{{ $item['name'] }}</td>
                    <td>Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>
                        <button class="btn btn-sm btn-secondary btn-decrease">-</button>
                        <span class="mx-2 qty">{{ $item['qty'] }}</span>
                        <button class="btn btn-sm btn-secondary btn-increase">+</button>
                    </td>
                    <td>Rp{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                    <td>
                        <button class="btn btn-sm btn-danger btn-remove">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form method="POST" action="/cart/checkout">
        @csrf
        <button class="btn btn-success">Checkout</button>
        <a href="/" class="btn btn-secondary">Kembali ke Halaman Utama</a>
    </form>
@endif
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.btn-increase').click(function () {
        const row = $(this).closest('tr');
        const code = row.data('code');

        $.post('/cart/increase/' + code, {_token: '{{ csrf_token() }}'}, function () {
            location.reload();
        });
    });

    $('.btn-decrease').click(function () {
        const row = $(this).closest('tr');
        const code = row.data('code');

        $.post('/cart/decrease/' + code, {_token: '{{ csrf_token() }}'}, function () {
            location.reload();
        });
    });

    $('.btn-remove').click(function () {
        const row = $(this).closest('tr');
        const code = row.data('code');

        $.post('/cart/remove/' + code, {_token: '{{ csrf_token() }}'}, function () {
            location.reload();
        });
    });
</script>
@endsection
