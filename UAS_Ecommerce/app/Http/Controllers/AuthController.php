<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth, Hash;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login() { return view('auth.login'); }
    public function register() { return view('auth.register'); }

    public function authenticate(Request $r) {
        if (Auth::attempt($r->only('email','password'))) {
            $r->session()->regenerate();
            return auth()->user()->role==='admin' ? redirect('/admin') : redirect('/');
        }
        return back()->withErrors(['email'=>'Login gagal']);
    }

    public function store(Request $r) {
        User::create([
            'name'=>$r->name,
            'email'=>$r->email,
            'password'=>Hash::make($r->password),
            'role'=>'user'
        ]);
        return redirect('/login')->with('success','Daftar berhasil');
    }

    public function logout(Request $r) {
        Auth::logout();
        $r->session()->invalidate();
        return redirect('/');
    }
}
