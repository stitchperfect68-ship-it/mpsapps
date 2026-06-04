@extends('layouts.app')
@section('title', 'Accounting')
@section('content')
<div class="page-header"><div style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(201,168,76,0.5);margin-bottom:6px;">Module 07</div><h1 class="page-title">📊 Accounting</h1></div>
<div class="page-body">
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">
    <a href="{{ route('accounting.income') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Income</div><div style="font-size:24px;margin-top:8px;">💰</div></a>
    <a href="{{ route('accounting.expenses') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Expenses</div><div style="font-size:24px;margin-top:8px;">📉</div></a>
    <a href="{{ route('accounting.ledger') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Ledger</div><div style="font-size:24px;margin-top:8px;">📒</div></a>
    <a href="{{ route('accounting.reports.zra') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">ZRA Reports</div><div style="font-size:24px;margin-top:8px;">🇿🇲</div></a>
</div>
<div class="card coming-soon" style="margin-top:24px;"><div class="icon">📊</div><h2>Full Accounting Module</h2><p>Coming soon — income statements, P&L, journal entries and ZRA reports.</p></div>
</div>
@endsection
