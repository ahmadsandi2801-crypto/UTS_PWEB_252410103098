@extends('layouts.app')

@section('title', 'Masuk')
@section('hide_nav', '1')

@section('content')
<div class="panel login-box">
    <div style="text-align: center; margin-bottom: 1.5rem;">
    <h1 class="logo">Login</h1>

    <form method="POST" action="{{ route('login.process') }}" novalidate style="text-align: left;">        @csrf
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" autofocus>
        @error('username')
            <small class="error">{{ $message }}</small>
        @enderror

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password">

        <button type="submit" class="btn">Masuk</button>
    </form>
</div>
@endsection
