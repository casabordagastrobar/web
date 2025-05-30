<?php

namespace App\Http\Controllers\Auth;

use App\Models\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProductoController extends Controller
{
    public function index()
{
    $productos = Product::all();
    return view('admin.productos.productos', compact('productos'));
}

public function create()
{
    return view('admin.productos.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'type' => 'required|string',
        'presentation' => 'required|string',
        'cost_price' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'stock' => 'required|integer',
        'min_stock' => 'required|integer',
    ]);

    Product::create($request->all());

    return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente.');
}

public function edit($id)
{
    $producto = Product::findOrFail($id);
    return view('admin.productos.editar', compact('producto'));
}

public function update(Request $request, $id)
{
    $producto = Product::findOrFail($id);

    $request->validate([
        'name' => 'required|string',
        'type' => 'required|string',
        'presentation' => 'required|string',
        'cost_price' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'stock' => 'required|integer',
        'min_stock' => 'required|integer',
    ]);

    $producto->update($request->all());

    return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
}

public function destroy($id)
{
    $producto = Product::findOrFail($id);
    $producto->delete();

    return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
}

}


