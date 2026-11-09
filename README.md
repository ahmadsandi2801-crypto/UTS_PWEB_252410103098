# UTS PWEB - TugasKu

Nama  : [Ahmad Snadi Fahman]
NIM   : [252410103098]
Kelas : [D]

## Tentang Web

TugasKu adalah aplikasi web manajemen tugas kuliah yang dibuat dengan Laravel [11/12] dan Blade. Pengguna login dengan username, lalu melihat ringkasan tugas di dashboard, profil, dan daftar tugas yang dikelompokkan menurut tenggat.

Aplikasi ini tidak memakai database dan tidak ada CRUD. Seluruh data tugas berupa array di controller. Tampilan ditulis dengan CSS sendiri tanpa template jadi dan responsif untuk layar kecil.

## Screenshot

### Login
![Login](screenshots/login.png)

### Dashboard
![Dashboard](screenshots/dashboard.png)

### Profil
![Profil](screenshots/profile.png)

### Pengelolaan Tugas
![Pengelolaan Tugas](screenshots/pengelolaan.png)

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
