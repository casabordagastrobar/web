@extends('layouts.admin')

@section('contenido')
<div class="form-container">
  <h2 class="mb-4">Registrar nueva salida de producto</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('salidas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="product_id" class="form-label">Producto</label>
      <select name="product_id" id="product_id" class="form-select" required>
        <option value="">Seleccione un producto</option>
        @foreach($products as $product)
          <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="quantity" class="form-label">Cantidad</label>
      <input type="number" name="quantity" id="quantity" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="exit_date" class="form-label">Fecha de salida</label>
      <input type="date" name="exit_date" id="exit_date" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="reason" class="form-label">Motivo de la salida</label>
      <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">Registrar salida</button>
  </form>
</div>
@endsection
