@extends('layouts.admin')

@section('contenido')
<div class="container">
  <h2 class="mb-4">Entradas registradas</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('entradas.create') }}" class="btn btn-success mb-3">➕ Registrar nueva entrada</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Costo</th>
        <th>Fecha</th>
        <th>Nota</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($entradas as $entrada)
        <tr>
          <td>{{ $entrada->product->name }}</td>
          <td>{{ $entrada->quantity }}</td>
          <td>${{ $entrada->cost }}</td>
          <td>{{ $entrada->entry_date }}</td>
          <td>{{ $entrada->note }}</td>
          <td>
            <a href="{{ route('entradas.edit', $entrada->id) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('entradas.destroy', $entrada->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta entrada?')">Eliminar</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
