@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="panel profile">
    <div class="avatar">{{ strtoupper(substr($username, 0, 1)) }}</div>
    <h1>{{ $username }}</h1>

    <ul class="detail">
        @foreach ($detail as $label => $isi)
            <li><span class="muted">{{ $label }}</span> <b>{{ $isi }}</b></li>
        @endforeach
    </ul>
</div>
@endsection
