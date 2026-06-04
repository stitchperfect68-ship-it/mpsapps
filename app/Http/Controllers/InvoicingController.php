<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicingController extends Controller
{
    public function index() { return view('invoicing.index', ['invoices' => Invoice::with('client')->latest()->paginate(20)]); }
    public function create() { return view('invoicing.create'); }
    public function store(Request $request) { return redirect()->route('invoicing.index'); }
    public function show(Invoice $invoice) { return view('invoicing.show', compact('invoice')); }
    public function edit(Invoice $invoice) { return view('invoicing.edit', compact('invoice')); }
    public function update(Request $request, Invoice $invoice) { return redirect()->route('invoicing.show', $invoice); }
    public function destroy(Invoice $invoice) { return redirect()->route('invoicing.index'); }
    public function send(Invoice $invoice) { return back(); }
    public function generatePdf(Invoice $invoice) { return back(); }
    public function markPaid(Request $request, Invoice $invoice) { return back(); }
    public function createQuote() { return view('invoicing.create'); }
    public function search() { return response()->json([]); }
}
