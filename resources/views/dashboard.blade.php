@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Halo, {{ $username }}</h1>

<div class="grid">
    @foreach ($ringkasan as $item)
        <div class="panel stat">
            <span class="muted">{{ $item['label'] }}</span>
            <strong>{{ $item['nilai'] }}</strong>
        </div>
    @endforeach
</div>

<div class="panel progress-box">
    <div class="row">
        <b>Progres keseluruhan</b>
        <span>{{ $progres }}%</span>
    </div>
    <div class="bar"><div class="fill" style="width: {{ $progres }}%"></div></div>
</div>

<h2>Tenggat Waktu</h2>
<ul class="deadline">
    @foreach ($terdekat as $t)
        <li class="p-{{ strtolower($t['prioritas']) }}">
            <div>
                <b>{{ $t['judul'] }}</b>
                <span class="muted">{{ $t['matkul'] }}</span>
            </div>
            <span class="date">{{ $t['waktu_tampil'] }}</span>
        </li>
    @endforeach
</ul>
@endsection
