<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\JournalEntry;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function index() { return view('accounting.index'); }
    public function income() { return view('accounting.index'); }
    public function expenses() { return view('accounting.index', ['expenses' => Expense::latest()->paginate(20)]); }
    public function storeExpense(Request $request) { return redirect()->route('accounting.expenses'); }
    public function ledger() { return view('accounting.index', ['entries' => JournalEntry::latest()->paginate(20)]); }
    public function monthlyReport() { return view('accounting.index'); }
    public function zraReport() { return view('accounting.index'); }
    public function profitLoss() { return view('accounting.index'); }
    public function suppliers() { return view('accounting.index', ['suppliers' => Supplier::paginate(20)]); }
    public function storeSupplier(Request $request) { return redirect()->route('accounting.suppliers'); }
    public function bankReconciliation() { return view('accounting.index'); }
}
