@extends('layouts.admin')

@section('contenido')
<div class="container">
  <h2 class="mb-4">Productos registrados</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('productos.create') }}" class="btn btn-success mb-3">➕ Crear nuevo producto</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Presentación</th>
        <th>Costo</th>
        <th>Venta</th>
        <th>Stock</th>
        <th>Stock Mínimo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($productos as $producto)
        <tr>
          <td>{{ $producto->name }}</td>
          <td>{{ $producto->type }}</td>
          <td>{{ $producto->presentation }}</td>
          <td>${{ $producto->cost_price }}</td>
          <td>${{ $producto->sale_price }}</td>
          <td>{{ $producto->stock }}</td>
          <td>{{ $producto->min_stock }}</td>
          <td>
            <a href="{{ route('productos.editar', $producto->id) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('productos.eliminar', $producto->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
