@extends('layouts.app')
@section('title', 'Inventory')
@section('content')
<div class="page-header">
    <div class="page-header-inner">
        <div><div style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(201,168,76,0.5);margin-bottom:6px;">Module 03</div><h1 class="page-title">🧵 Inventory</h1></div>
        <a href="{{ route('inventory.create') }}" class="btn-gold">+ Add Item</a>
    </div>
</div>
<div class="page-body">
    <div class="card">
        <table>
            <thead><tr><th>SKU</th><th>Item</th><th>Category</th><th>Quantity</th><th>Unit</th><th>Status</th></tr></thead>
            <tbody>
            @forelse($items as $item)
                <tr>
                    <td style="color:rgba(245,240,232,0.4);font-size:11px;">{{ $item->sku }}</td>
                    <td><a href="{{ route('inventory.show', $item) }}" style="color:#C9A84C;">{{ $item->name }}</a></td>
                    <td>{{ $item->category?->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td><span class="badge" style="background:{{ $item->status === 'low_stock' ? 'rgba(184,92,56,0.15)' : 'rgba(34,197,94,0.1)' }};color:{{ $item->status === 'low_stock' ? '#B85C38' : '#22c55e' }};">{{ ucfirst(str_replace('_',' ',$item->status)) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;padding:40px;color:rgba(245,240,232,0.3);">No inventory items yet</td></tr>
            @endforelse
            </tbody>
        </table>
        <div style="padding:16px 20px;">{{ $items->links() }}</div>
    </div>
</div>
@endsection
