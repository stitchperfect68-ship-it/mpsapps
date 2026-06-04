@extends('layouts.app')
@section('title', 'Order Detail')
@section('content')
<div class="page-header"><h1 class="page-title">{{ $order->order_number }}</h1></div>
<div class="page-body"><div class="card coming-soon"><div class="icon">🏭</div><h2>Order Detail</h2><p>Full order view coming soon.</p><a href="{{ route('production.index') }}" class="btn-outline" style="margin-top:20px;">← Back</a></div></div>
@endsection
