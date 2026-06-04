@extends('layouts.app')
@section('title', 'Inventory Item')
@section('content')
<div class="page-header"><h1 class="page-title">{{ $item->name }}</h1></div>
<div class="page-body"><div class="card coming-soon"><div class="icon">🧵</div><h2>Item Detail</h2><p>Full item view coming soon.</p><a href="{{ route('inventory.index') }}" class="btn-outline" style="margin-top:20px;">← Back</a></div></div>
@endsection
