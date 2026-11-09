<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate(
            ['username' => 'required|min:3'],
            [
                'username.required' => 'Username wajib diisi.',
                'username.min' => 'Username minimal 3 karakter.',
            ]
        );

        return redirect()->route('dashboard', ['username' => $request->username]);
    }

    public function dashboard(Request $request)
    {
        if (!$username = $request->query('username')) {
            return redirect()->route('login');
        }

        $tugas = $this->dataTugas($username);
        $total = count($tugas);
        $selesai = count($this->filterStatus($tugas, 'Selesai'));
        $progres = $total ? round($selesai / $total * 100) : 0;

        $ringkasan = [
            ['label' => 'Total tugas', 'nilai' => $total],
            ['label' => 'Selesai', 'nilai' => $selesai],
            ['label' => 'Belum selesai', 'nilai' => $total - $selesai],
        ];

        $terdekat = array_values(array_filter($tugas, fn ($t) => $t['status'] !== 'Selesai'));
        usort($terdekat, fn ($a, $b) => strcmp($a['tenggat'], $b['tenggat']));
        $terdekat = array_slice($terdekat, 0, 3);

        return view('dashboard', compact('username', 'ringkasan', 'progres', 'terdekat'));
    }

    public function pengelolaan(Request $request)
    {
        if (!$username = $request->query('username')) {
            return redirect()->route('login');
        }

        $tugas = $this->dataTugas($username);
        $hariIni = Carbon::today()->format('Y-m-d');

        $tugasHariIni = array_values(array_filter($tugas, fn ($t) => $t['tenggat'] === $hariIni));
        $akanDatang = array_values(array_filter($tugas, fn ($t) => $t['tenggat'] > $hariIni));
        usort($akanDatang, fn ($a, $b) => strcmp($a['tenggat'] . $a['jam'], $b['tenggat'] . $b['jam']));

        $sudahLewat = array_values(array_filter($tugas, fn ($t) => $t['tenggat'] < $hariIni));

        $kelompok = [
            'Tugas hari ini' => $tugasHariIni,
            'Tugas yang akan datang' => $akanDatang,
            'Sudah lewat' => $sudahLewat,
        ];
        $selesai = count($this->filterStatus($tugas, 'Selesai'));
        $kartu = [
            ['label' => 'Tugas hari ini', 'nilai' => count($tugasHariIni)],
            ['label' => 'Jumlah tugas', 'nilai' => count($tugas)],
            ['label' => 'Tugas selesai', 'nilai' => $selesai . ' / ' . count($tugas)],
        ];

        $namaHari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        $mingguan = [];
        for ($i = 0; $i < 7; $i++) {
            $tgl = Carbon::today()->addDays($i);
            $mingguan[] = [
                'hari' => $namaHari[$tgl->dayOfWeek],
                'jumlah' => count(array_filter($tugas, fn ($t) => $t['tenggat'] === $tgl->format('Y-m-d'))),
            ];
        }

        return view('pengelolaan', compact('username', 'kartu', 'kelompok', 'mingguan'));
    }

    public function profile(Request $request)
    {
        if (!$username = $request->query('username')) {
            return redirect()->route('login');
        }

        $tugas = $this->dataTugas($username);

        $detail = [
            'Peran' => 'Mahasiswa',
            'Program studi' => 'Sistem Informasi',
            'Semester' => '5',
            'Tugas aktif' => count($tugas) - count($this->filterStatus($tugas, 'Selesai')),
        ];

        return view('profile', compact('username', 'detail'));
    }

    private function filterStatus(array $tugas, string $status): array
    {
        return array_values(array_filter($tugas, fn ($t) => $t['status'] === $status));
    }

    private function dataTugas(string $username): array
    {
        $hari = fn (int $n) => Carbon::today()->addDays($n)->format('Y-m-d');

        $semua = [
            'rina' => [
                ['judul' => 'Laporan praktikum basis data', 'matkul' => 'Basis Data', 'tenggat' => $hari(0), 'jam' => '10.00', 'prioritas' => 'Tinggi', 'status' => 'Dikerjakan'],
                ['judul' => 'Proyek UTS Laravel', 'matkul' => 'Pemrograman Web', 'tenggat' => $hari(0), 'jam' => '14.00', 'prioritas' => 'Tinggi', 'status' => 'Dikerjakan'],
                ['judul' => 'Rangkuman jurnal interaksi manusia', 'matkul' => 'IMK', 'tenggat' => $hari(1), 'jam' => '10.00', 'prioritas' => 'Sedang', 'status' => 'Belum'],
                ['judul' => 'Diagram use case sistem perpustakaan', 'matkul' => 'RPL', 'tenggat' => $hari(3), 'jam' => '16.00', 'prioritas' => 'Sedang', 'status' => 'Belum'],
                ['judul' => 'Kuis jaringan komputer bab 4', 'matkul' => 'Jaringan Komputer', 'tenggat' => $hari(-2), 'jam' => '09.00', 'prioritas' => 'Rendah', 'status' => 'Selesai'],
                ['judul' => 'Presentasi kelompok analisis proses bisnis', 'matkul' => 'Analisis Proses Bisnis', 'tenggat' => $hari(-4), 'jam' => '13.00', 'prioritas' => 'Tinggi', 'status' => 'Selesai'],
            ],
            'budi' => [
                ['judul' => 'Makalah etika profesi', 'matkul' => 'Etika Profesi', 'tenggat' => $hari(0), 'prioritas' => 'Sedang', 'status' => 'Selesai'],
                ['judul' => 'Tugas algoritma pengurutan', 'matkul' => 'Algoritma', 'tenggat' => $hari(-5), 'prioritas' => 'Tinggi', 'status' => 'Selesai'],
                ['judul' => 'Desain mockup aplikasi kampus', 'matkul' => 'IMK', 'tenggat' => $hari(8), 'prioritas' => 'Rendah', 'status' => 'Selesai'],
                ['judul' => 'Proyek UTS Laravel', 'matkul' => 'Pemrograman Web', 'tenggat' => $hari(0), 'prioritas' => 'Tinggi', 'status' => 'Dikerjakan'],
            ],
            'default' => [
                ['judul' => 'Proyek UTS Laravel', 'matkul' => 'Pemrograman Web', 'tenggat' => $hari(5), 'prioritas' => 'Tinggi', 'status' => 'Belum'],
                ['judul' => 'Laporan praktikum', 'matkul' => 'Basis Data', 'tenggat' => $hari(2), 'prioritas' => 'Sedang', 'status' => 'Belum'],
                ['judul' => 'Kuis bab 1', 'matkul' => 'Jaringan Komputer', 'tenggat' => $hari(-3), 'prioritas' => 'Rendah', 'status' => 'Selesai'],
            ],
        ];

        $data = $semua[strtolower($username)] ?? $semua['default'];

        return array_map(function ($t) {
            $tgl = Carbon::parse($t['tenggat']);
            $t['jam'] = $t['jam'] ?? '23.59';
            $t['tenggat_tampil'] = $tgl->format('d/m/Y');
            $t['waktu_tampil'] = ($tgl->isToday() ? 'Hari ini' : ($tgl->isTomorrow() ? 'Besok' : $tgl->format('d/m/Y'))) . ', ' . $t['jam'];
            return $t;
        }, $data);
    }
}