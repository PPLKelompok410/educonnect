<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Educonnect' }}</title>

    <!-- Font Awesome dan Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container py-4">

        <!-- Header -->
        <header class="mb-4">
            <h1>
                <a href="{{ route('notes.index') }}" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-sticky-note"></i> Educonnect
                </a>
            </h1>

            <nav class="mb-3">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notes.index') }}"><i class="fas fa-home"></i> Semua Catatan</a>
                    </li>

                    @if (auth()->check())
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endif
                </ul>
            </nav>
        </header>

        <!-- Konten Halaman -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-5 text-center text-muted">
            <hr>
            <p>&copy; {{ date('Y') }} Educonnect</p>
        </footer>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
