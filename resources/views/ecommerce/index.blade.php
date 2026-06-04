@extends('layouts.app')
@section('title', 'Ecommerce')
@section('content')
<div class="page-header"><div style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(201,168,76,0.5);margin-bottom:6px;">Module 06</div><h1 class="page-title">🛍️ Ecommerce</h1></div>
<div class="page-body">
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:28px;">
    <a href="{{ route('ecommerce.orders') }}" class="card" style="padding:20px;text-decoration:none;display:block;">
        <div style="font-size:10px;letter-spacing:0.15em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Shop Orders</div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:32px;color:#22c55e;margin-top:4px;">{{ $orders->total() ?? 0 }}</div>
    </a>
    <a href="{{ route('ecommerce.products') }}" class="card" style="padding:20px;text-decoration:none;display:block;">
        <div style="font-size:10px;letter-spacing:0.15em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Products</div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:32px;color:#C9A84C;margin-top:4px;">—</div>
    </a>
    <a href="{{ route('ecommerce.customers') }}" class="card" style="padding:20px;text-decoration:none;display:block;">
        <div style="font-size:10px;letter-spacing:0.15em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Customers</div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:32px;color:#F5F0E8;margin-top:4px;">—</div>
    </a>
</div>
</div>
@endsection
