<?php

namespace App\Http\Controllers;

use App\Models\ProductionOrder;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index() { return view('production.index', ['orders' => ProductionOrder::with('client')->latest()->paginate(20)]); }
    public function kanban() { return view('production.board'); }
    public function create() { return view('production.create'); }
    public function store(Request $request) { return redirect()->route('production.index'); }
    public function show(ProductionOrder $order) { return view('production.show', compact('order')); }
    public function updateStage(Request $request, ProductionOrder $order) { return back(); }
    public function qcCheckpoint(Request $request, ProductionOrder $order) { return back(); }
    public function assignStaff(Request $request, ProductionOrder $order) { return back(); }
    public function calendar() { return view('production.index'); }
}
