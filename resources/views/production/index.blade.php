@extends('layouts.app')
@section('title', 'Order & Production')
@section('content')
<div class="page-header">
    <div class="page-header-inner">
        <div><div style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(201,168,76,0.5);margin-bottom:6px;">Module 02</div><h1 class="page-title">🏭 Order & Production</h1></div>
        <a href="{{ route('production.create') }}" class="btn-gold">+ New Order</a>
    </div>
</div>
<div class="page-body">
    <div class="card">
        <table>
            <thead><tr><th>Order #</th><th>Client</th><th>Product</th><th>Stage</th><th>Priority</th><th>Due</th></tr></thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td><a href="{{ route('production.show', $order) }}" style="color:#C9A84C;">{{ $order->order_number }}</a></td>
                    <td>{{ $order->client?->name }}</td>
                    <td>{{ $order->product_type }}</td>
                    <td><span class="badge" style="background:rgba(42,107,107,0.2);color:#3D9E9E;">{{ ucfirst($order->stage) }}</span></td>
                    <td>{{ ucfirst($order->priority) }}</td>
                    <td>{{ $order->due_date?->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;padding:40px;color:rgba(245,240,232,0.3);">No orders yet</td></tr>
            @endforelse
            </tbody>
        </table>
        <div style="padding:16px 20px;">{{ $orders->links() }}</div>
    </div>
</div>
@endsection
