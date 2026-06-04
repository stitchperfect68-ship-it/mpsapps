<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index() { return view('inventory.index', ['items' => InventoryItem::with('category')->latest()->paginate(20)]); }
    public function create() { return view('inventory.create'); }
    public function store(Request $request) { return redirect()->route('inventory.index'); }
    public function show(InventoryItem $item) { return view('inventory.show', compact('item')); }
    public function update(Request $request, InventoryItem $item) { return redirect()->route('inventory.show', $item); }
    public function destroy(InventoryItem $item) { return redirect()->route('inventory.index'); }
    public function restock(Request $request, InventoryItem $item) { return back(); }
    public function deduct(Request $request, InventoryItem $item) { return back(); }
    public function lowStockAlerts() { return view('inventory.index', ['items' => InventoryItem::where('status', 'low_stock')->paginate(20)]); }
    public function usageReport() { return view('inventory.index', ['items' => collect()]); }
}
