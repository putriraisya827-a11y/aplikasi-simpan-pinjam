<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Simpan Pinjam</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Aplikasi Simpan Pinjam</a>

            <div class="navbar-nav">
                <a class="nav-link text-white" href="{{ route('anggota.index') }}">Anggota</a>
                <a class="nav-link text-white" href="{{ route('simpanan.index') }}">Simpanan</a>
                <a class="nav-link text-white" href="{{ route('pinjaman.index') }}">Pinjaman</a>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>