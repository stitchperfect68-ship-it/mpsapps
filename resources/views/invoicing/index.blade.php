@extends('layouts.app')
@section('title', 'Smart Invoicing')
@section('content')
<div class="page-header">
    <div class="page-header-inner">
        <div>
            <div style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(201,168,76,0.5);margin-bottom:6px;">Module 01</div>
            <h1 class="page-title">🧾 Smart Invoicing</h1>
        </div>
        <a href="{{ route('invoicing.create') }}" class="btn-gold">+ New Invoice</a>
    </div>
</div>
<div class="page-body">
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Invoice #</th><th>Client</th><th>Amount</th><th>Status</th><th>Due Date</th><th></th>
                </tr>
            </thead>
            <tbody>
            @forelse($invoices as $invoice)
                <tr>
                    <td><a href="{{ route('invoicing.show', $invoice) }}" style="color:#C9A84C;">{{ $invoice->invoice_number }}</a></td>
                    <td>{{ $invoice->client?->name }}</td>
                    <td>ZMW {{ number_format($invoice->total, 2) }}</td>
                    <td><span class="badge" style="background:rgba(201,168,76,0.1);color:#C9A84C;">{{ ucfirst($invoice->status) }}</span></td>
                    <td>{{ $invoice->due_date?->format('d M Y') }}</td>
                    <td><a href="{{ route('invoicing.show', $invoice) }}" style="color:rgba(201,168,76,0.5);font-size:12px;">View →</a></td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;padding:40px;color:rgba(245,240,232,0.3);">No invoices yet</td></tr>
            @endforelse
            </tbody>
        </table>
        <div style="padding:16px 20px;">{{ $invoices->links() }}</div>
    </div>
</div>
@endsection
