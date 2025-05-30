<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\InventoryExit;

class SalidaController extends Controller
{
   public function index() {
    $salidas = InventoryExit::with('product')->get();
    return view('admin.salidas.index', compact('salidas'));
}

public function create() {
    $products = Product::all();
    return view('admin.salidas.create', compact('products'));
}

public function edit($id) {
    $salida = InventoryExit::findOrFail($id);
    $products = Product::all();
    return view('admin.salidas.edit', compact('salida', 'products'));
}

public function destroy($id) {
    InventoryExit::findOrFail($id)->delete();
    return redirect()->route('salidas.index')->with('success', 'Salida eliminada correctamente.');
}

public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'exit_date' => 'required|date',
        'reason' => 'nullable|string',
    ]);

    // Buscar el producto
    $producto = Product::find($request->product_id);

    // Validar que haya stock suficiente
    if ($producto->stock < $request->quantity) {
        return redirect()->back()->with('error', 'Stock insuficiente para realizar la salida.');
    }

    // Registrar la salida
    InventoryExit::create($request->all());

    // Restar la cantidad al stock
    $producto->stock -= $request->quantity;
    $producto->save();

    return redirect()->route('salidas.index')->with('success', 'Salida registrada y stock actualizado correctamente.');
}

}
