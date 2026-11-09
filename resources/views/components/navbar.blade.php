@props(['username' => ''])

<header class="navbar">
    <a class="brand" href="{{ route('dashboard', ['username' => $username]) }}">Tugas<mark>Ku</mark></a>

    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="hamburger" aria-label="Buka menu">&#9776;</label>

    <nav class="nav-links">
        <a href="{{ route('dashboard', ['username' => $username]) }}" @class(['aktif' => request()->routeIs('dashboard')])>Dashboard</a>
        <a href="{{ route('pengelolaan', ['username' => $username]) }}" @class(['aktif' => request()->routeIs('pengelolaan')])>Tugas</a>
        <a href="{{ route('profile', ['username' => $username]) }}" @class(['aktif' => request()->routeIs('profile')])>Profile</a>
        <a href="{{ route('login') }}">Keluar</a>
    </nav>
</header>
