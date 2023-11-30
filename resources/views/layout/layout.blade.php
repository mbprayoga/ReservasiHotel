<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Reservation</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <nav class="navbar navbar-light" style="background-color: #383837">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home.index') }}" style="color: #ffffff">Hotel Reservation
            </a>
            <a href="{{ route('home.index') }}" type="button" class="btn btn rounded-3" style="color: #ffffff">Home </a>
            <a href="{{ route('tamu.index') }}" type="button" class="btn btn rounded-3" style="color: #ffffff">Data Tamu</a>
            <a href="{{ route('kamar.index') }}" type="button" class="btn btn rounded-3" style="color: #ffffff">Data Kamar</a>
            <a href="{{ route('reservasi.index') }}" type="button" class="btn btn rounded-3" style="color: #ffffff">Data Reservasi</a>
            <a href="{{ route('account.index') }}" type="button" class="btn btn rounded-3" style="color: #ffffff">Akun</a>
            <a href="{{ route('login.logout') }}" type="button" class="btn btn-danger rounded-3" style="float:right">Log Out</a>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>

</html>