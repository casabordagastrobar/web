<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f4f4f4;
    }
    .login-box {
      width: 100%;
      max-width: 400px;
      padding: 40px;
      border: 1px solid #ccc;
      border-radius: 12px;
      background-color: #fff;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .login-box .avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 30px;
      border: 2px solid #000;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #eee;
    }
    .login-box .avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }
    .form-control { margin-bottom: 20px; }
    button {
      width: 100%;
      padding: 10px;
      font-weight: bold;
    }
    .link {
      margin-top: 20px;
      display: block;
    }
    .alert { text-align: left; }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="avatar">
      <img src="img/casabordafinal.png" alt="Prueba">

    </div>
    <form action="{{ route('login') }}" method="post">
      @csrf
      <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror"
        placeholder="Correo electrónico" value="{{ old('correo') }}" />
      @error('correo')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
        placeholder="Contraseña" />
      @error('password')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      @if(Session::has('error'))
      <div class="alert alert-danger">{{ Session::get('error') }}</div>
      @endif
      @if(Session::has('success'))
      <div class="alert alert-success">{{ Session::get('success') }}</div>
      @endif
      <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
      
      
    </form>
  </div>
</body>
</html>
