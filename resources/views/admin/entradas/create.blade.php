@extends('layouts.admin')

@section('contenido')
<div class="form-container">
  <div class="form-title">Registrar nueva entrada de producto</div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('entradas.store') }}" method="POST">
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
      <label for="cost" class="form-label">Costo</label>
      <input type="number" name="cost" id="quantity" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="entry_date" class="form-label">Fecha de entrada</label>
      <input type="date" name="entry_date" id="entry_date" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="note" class="form-label">Nota</label>
      <textarea name="note" id="note" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">Guardar entrada</button>
  </form>
</div>
@endsection
