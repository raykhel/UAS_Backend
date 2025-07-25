@extends('layouts.app')
@section('content')
<h2 class="mb-4">Register</h2>
<form method="POST" action="/register">
  @csrf
  <div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button class="btn btn-success">Daftar</button>
</form>
@endsection