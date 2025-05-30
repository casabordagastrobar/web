<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\InventoryEntry;

class EntradasController extends Controller
{
public function index()
{
    $entradas = InventoryEntry::with('product')->get();
    return view('admin.entradas.index', compact('entradas'));
}

public function create()
{
    $products = Product::all();
    return view('admin.entradas.create', compact('products'));
}

public function edit($id)
{
    $entrada = InventoryEntry::findOrFail($id);
    $products = Product::all();
    return view('admin.entradas.edit', compact('entrada', 'products'));
}

public function destroy($id)
{
    InventoryEntry::findOrFail($id)->delete();
    return redirect()->route('entradas.index')->with('success', 'Entrada eliminada correctamente.');
}

public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'entry_date' => 'required|date',
        'note' => 'nullable|string',
    ]);

    // 1. Registrar la entrada
    $entrada = InventoryEntry::create($request->all());

    // 2. Sumar al stock del producto
    $producto = Product::find($request->product_id);
    $producto->stock += $request->quantity;
    $producto->save();

    return redirect()->route('entradas.index')->with('success', 'Entrada registrada y stock actualizado correctamente.');
}
}
