@extends('layouts.admin')

@section('title', 'Editar Usuario')
@section('contenido')
<div class="container">
  <h2 class="mb-4">Editar Usuario</h2>

  <form action="{{ route('usuarios.actualizar', $usuario->id) }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Nombre</label>
      <input type="text" name="name" id="name" value="{{ $usuario->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="email" name="email" id="email" value="{{ $usuario->email }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Nueva contraseña (opcional)</label>
      <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Guardar cambios</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection
