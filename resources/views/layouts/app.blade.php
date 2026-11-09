<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | TugasKu</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @unless (View::hasSection('hide_nav'))
        <x-navbar :username="request('username')" />
    @endunless

    <main class="container">
        @yield('content')
    </main>

</body>
</html>
