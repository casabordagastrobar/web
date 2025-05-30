@extends('layouts.admin')

@section('title', 'Editar Producto')
@section('contenido')
<div class="container">
    <h2 class="mb-4">Editar Producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups!</strong> Hay algunos errores en el formulario.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.actualizar', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $producto->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Tipo</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $producto->type) }}" required>
        </div>

        <div class="mb-3">
            <label for="presentation" class="form-label">Presentación</label>
            <input type="text" name="presentation" class="form-control" value="{{ old('presentation', $producto->presentation) }}" required>
        </div>

        <div class="mb-3">
            <label for="cost_price" class="form-label">Precio de Costo</label>
            <input type="number" step="0.01" name="cost_price" class="form-control" value="{{ old('cost_price', $producto->cost_price) }}" required>
        </div>

        <div class="mb-3">
            <label for="sale_price" class="form-label">Precio de Venta</label>
            <input type="number" step="0.01" name="sale_price" class="form-control" value="{{ old('sale_price', $producto->sale_price) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $producto->stock) }}" required>
        </div>

        <div class="mb-3">
            <label for="min_stock" class="form-label">Stock Mínimo</label>
            <input type="number" name="min_stock" class="form-control" value="{{ old('min_stock', $producto->min_stock) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
