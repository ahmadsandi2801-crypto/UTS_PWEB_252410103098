# UTS PWEB - TugasKu

Nama  : [Ahmad Snadi Fahman]
NIM   : [252410103098]
Kelas : [D]

## Tentang Web

TugasKu adalah aplikasi web manajemen tugas kuliah yang dibuat dengan Laravel [11/12] dan Blade. Pengguna login dengan username, lalu melihat ringkasan tugas di dashboard, profil, dan daftar tugas yang dikelompokkan menurut tenggat.

Aplikasi ini tidak memakai database dan tidak ada CRUD. Seluruh data tugas berupa array di controller. Tampilan ditulis dengan CSS sendiri tanpa template jadi dan responsif untuk layar kecil.

## Screenshot

### Login
<img width="1218" height="577" alt="Cuplikan layar 2026-11-09 223319" src="https://github.com/user-attachments/assets/6fe45ed2-6ee6-48a6-a271-0a3ab41777a0" />

### Dashboard
<img width="1344" height="617" alt="Cuplikan layar 2026-11-09 223338" src="https://github.com/user-attachments/assets/0eca0109-ee62-4f68-867f-10041949838e" />


### Profil
<img width="1358" height="623" alt="Cuplikan layar 2026-11-09 223407" src="https://github.com/user-attachments/assets/c2ca69db-599d-4e34-8235-d9866f663631" />


### Pengelolaan Tugas
<img width="1343" height="622" alt="Cuplikan layar 2026-11-09 223355" src="https://github.com/user-attachments/assets/0656a24a-e1da-4d65-b0ac-a39c9d30003c" />


## Struktur File Utama

| Bagian | File |
|---|---|
| Route | `routes/web.php` |
| Controller | `app/Http/Controllers/PageController.php` |
| Layout | `resources/views/layouts/app.blade.php` |
| View | `login`, `dashboard`, `pengelolaan`, `profile` di `resources/views/` |
| Component | `components/navbar.blade.php`, `components/footer.blade.php` |

## Alur Data

1. Form login mengirim `username` lewat POST.
2. `PageController@login` memvalidasi, lalu redirect ke `/dashboard?username=...`.
3. Link di navbar membawa parameter `username` ke Profile dan Pengelolaan.
4. Controller mengambil array tugas sesuai username, lalu mengirimnya ke view dengan `compact()`.
5. View menampilkan data dengan `@foreach`.

## Cara Menjalankan

Kebutuhan: PHP 8.2 atau lebih baru dan Composer.

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan serve
```

Buka `http://127.0.0.1:8000`. Login dengan username `rina` atau `budi` untuk melihat data berbeda. Username lain memakai data default. Password bebas.
