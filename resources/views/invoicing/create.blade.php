@extends('layouts.app')
@section('title', 'New Invoice')
@section('content')
<div class="page-header"><h1 class="page-title">🧾 New Invoice</h1></div>
<div class="page-body"><div class="card coming-soon"><div class="icon">🚧</div><h2>Invoice Builder</h2><p>Coming soon — full invoice creation form.</p><a href="{{ route('invoicing.index') }}" class="btn-outline" style="margin-top:20px;">← Back</a></div></div>
@endsection
