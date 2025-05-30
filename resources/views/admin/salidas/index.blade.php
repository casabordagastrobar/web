@extends('layouts.admin')

@section('contenido')
<div class="container">
  <h2 class="mb-4">Salidas registradas</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('salidas.create') }}" class="btn btn-success mb-3">➕ Registrar nueva salida</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Fecha de salida</th>
        <th>Motivo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($salidas as $salida)
        <tr>
          <td>{{ $salida->product->name }}</td>
          <td>{{ $salida->quantity }}</td>
          <td>{{ $salida->exit_date }}</td>
          <td>{{ $salida->reason }}</td>
          <td>
            <a href="{{ route('salidas.edit', $salida->id) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('salidas.destroy', $salida->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta salida?')">Eliminar</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
