<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #f8f9fa, #e9ecef);
    }

    .container-fluid {
      display: flex;
      height: 100vh;
      padding: 0;
    }

    .sidebar {
      width: 180px;
      background-color: #fff;
      border-right: 1px solid #dee2e6;
      padding: 20px 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .profile-circle {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      overflow: hidden;
      border: 2px solid #adb5bd;
      margin-bottom: 20px;
      background-color: #dee2e6;
    }

    .profile-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .sidebar a {
      display: block;
      width: 100%;
      padding: 10px;
      color: #212529;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
      text-align: center;
    }

    .sidebar a:hover {
      background-color: #f1f3f5;
    }

    .content-area {
      flex-grow: 1;
      padding: 40px;
      overflow-y: auto;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <aside class="sidebar">
      <div class="profile-circle mb-2">
        <img src="{{ asset('img/perfil.png') }}" alt="Perfil" class="profile-img">
      </div>
      <div class="card text-center mb-3 p-2">
  <strong>{{ auth()->user()->name }}</strong>
  <small class="text-muted d-block">{{ auth()->user()->email }}</small>
  <span class="badge bg-secondary mt-1">{{ ucfirst(auth()->user()->role) }}</span>
</div>

      <form action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data" class="w-100 px-2 mb-2">
        @csrf
        <input type="file" name="foto" accept="image/*" class="form-control form-control-sm mb-2" required>
        <button type="submit" class="btn btn-sm btn-outline-secondary w-100">Actualizar imagen</button>
      </form>

      <a href="{{ route('admin.dashboard') }}">🏠 Inicio</a>
      <a href="{{ route('usuarios.index') }}">👤 Usuarios</a>
      <a href="{{ route('productos.index') }}">🍺 Productos</a>
      <a href="{{route('entradas.index')}}">📥 Entradas</a>
      <a href="{{ route('salidas.index') }}">📤 Salidas</a>


      <form method="POST" action="{{ route('logout') }}" class="mt-auto w-100 px-2">
        @csrf
        <button type="submit" class="btn btn-sm btn-danger w-100 mt-3">Cerrar sesión</button>
      </form>
    </aside>

    <main class="content-area">
      @yield('contenido')
    </main>
  </div>
</body>
</html>
