<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientInteraction;
use Illuminate\Http\Request;

class CrmController extends Controller
{
    public function index() { return view('crm.index', ['clients' => Client::latest()->paginate(20)]); }
    public function createClient() { return view('crm.create'); }
    public function storeClient(Request $request) { return redirect()->route('crm.index'); }
    public function showClient(Client $client) { return view('crm.show', compact('client')); }
    public function editClient(Client $client) { return view('crm.edit', compact('client')); }
    public function updateClient(Request $request, Client $client) { return redirect()->route('crm.clients.show', $client); }
    public function destroyClient(Client $client) { return redirect()->route('crm.index'); }
    public function pipeline() { return view('crm.index', ['clients' => Client::all()]); }
    public function logInteraction(Request $request) { return back(); }
    public function reports() { return view('crm.index', ['clients' => collect()]); }
    public function search() { return response()->json([]); }
}
