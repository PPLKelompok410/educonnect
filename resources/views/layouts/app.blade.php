<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Educonnect')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #87CEEB;">
    <div class="container">
      <a class="navbar-brand fw-bold text-white" href="/">Educonnect</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link text-white" href="#">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#">Catatan</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="#">Profil</a></li>
        </ul>

        <a href="#" class="btn btn-outline-light">Sign Out</a>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <div class="py-4">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>