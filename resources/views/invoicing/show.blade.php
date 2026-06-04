@extends('layouts.app')
@section('title', 'Invoice')
@section('content')
<div class="page-header"><h1 class="page-title">Invoice {{ $invoice->invoice_number }}</h1></div>
<div class="page-body"><div class="card coming-soon"><div class="icon">🧾</div><h2>Invoice Detail</h2><p>Full invoice view coming soon.</p><a href="{{ route('invoicing.index') }}" class="btn-outline" style="margin-top:20px;">← Back</a></div></div>
@endsection
