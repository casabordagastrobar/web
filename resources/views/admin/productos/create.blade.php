@extends('layouts.admin')

@section('contenido')
  <h2 class="mb-4">Agregar nuevo producto</h2>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('productos.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Nombre del producto</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="type" class="form-label">Tipo</label>
      <input type="text" name="type" id="type" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="presentation" class="form-label">Presentación</label>
      <input type="text" name="presentation" id="presentation" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="cost_price" class="form-label">Precio de costo</label>
      <input type="number" name="cost_price" id="cost_price" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="sale_price" class="form-label">Precio de venta</label>
      <input type="number" name="sale_price" id="sale_price" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="stock" class="form-label">Stock actual</label>
      <input type="number" name="stock" id="stock" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="min_stock" class="form-label">Stock mínimo</label>
      <input type="number" name="min_stock" id="min_stock" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Guardar producto</button>
  </form>
@endsection
