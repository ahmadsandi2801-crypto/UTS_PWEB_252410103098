@extends('layouts.app')

@section('title', 'Tugas Saya')

@section('content')
<h1>Tugas saya</h1>

<div class="grid">
    @foreach ($kartu as $k)
        <div class="panel stat">
            <span class="muted">{{ $k['label'] }}</span>
            <strong>{{ $k['nilai'] }}</strong>
        </div>
    @endforeach
</div>

<div class="dua-kolom">
    <div>
        @foreach ($kelompok as $judul => $daftar)
            <h2>{{ $judul }}</h2>
            <ul class="daftar">
                @forelse ($daftar as $t)
                    <li>
                        <input type="checkbox" disabled @checked($t['status'] === 'Selesai')>
                        <div class="isi">
                            <b>{{ $t['judul'] }}</b>
                            <span>{{ $t['matkul'] }}</span>
                        </div>
                        <span class="waktu">{{ $t['waktu_tampil'] }}</span>
                    </li>
                @empty
                    <li class="muted">Tidak ada tugas.</li>
                @endforelse
            </ul>
        @endforeach
    </div>

    <aside class="panel">
        <h2 style="margin-top:0">Tenggat 7 hari</h2>
        <div class="batang">
            @foreach ($mingguan as $m)
                <div class="kolom">
                    <span>{{ $m['jumlah'] }}</span>
                    <div class="tiang" style="height: {{ $m['jumlah'] * 30 }}px"></div>
                    <small class="muted">{{ $m['hari'] }}</small>
                </div>
            @endforeach
        </div>
    </aside>
</div>
@endsection