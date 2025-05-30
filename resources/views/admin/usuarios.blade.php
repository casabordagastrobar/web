<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fa;
    }
    .container-fluid { display: flex; height: 100vh; }
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
      background-color: #dee2e6;
      border-radius: 50%;
      margin-bottom: 20px;
      border: 2px solid #adb5bd;
      overflow: hidden;
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
    <form action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data" class="w-100 px-2">
  @csrf
  <input type="file" name="foto" accept="image/*" class="form-control form-control-sm mb-2" required>
  <button type="submit" class="btn btn-sm btn-outline-secondary w-100">Actualizar imagen</button>
</form>

    <a href="{{ route('admin.dashboard') }}">🏠 Inicio</a>
    <a href="{{ route('usuarios.index') }}">👤 Usuarios</a>
    <a href="{{route('productos.index')}}">🍺 Productos</a>
    <a href="{{route('entradas.create')}}">📥 Entradas</a>
    <a href="#">📤 Salidas</a>

    <form action="{{ route('logout') }}" method="POST" class="mt-auto w-100 px-2">
      @csrf
      <button type="submit" class="btn btn-sm btn-danger w-100">Cerrar sesión</button>
    </form>
  </aside>

  <main class="content-area">
    <h2>Usuarios registrados</h2>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
     <a href="{{ route('admin.dashboard') }}" class="btn btn-success mb-3">➕ Crear Usuario</a>
    <table class="table table-bordered mt-4">
      <thead class="table-dark">
        <tr>
        
          <th>Nombre</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usuarios as $usuario)
          <tr>
           
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->role }}</td>
            <td>
              <a href="{{ route('usuarios.editar', $usuario->id) }}" class="btn btn-sm btn-warning">Editar</a>
              <form action="{{ route('usuarios.eliminar', $usuario->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </main>
</div>
</body>
</html>
