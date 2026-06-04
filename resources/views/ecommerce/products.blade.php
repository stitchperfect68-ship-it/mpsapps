@extends('layouts.app')
@section('title', 'Products')
@section('content')
<div class="page-header">
    <div class="page-header-inner"><h1 class="page-title">🛍️ Products</h1><a href="{{ route('ecommerce.products.create') }}" class="btn-gold">+ Add Product</a></div>
</div>
<div class="page-body"><div class="card coming-soon"><div class="icon">🚧</div><h2>Product Catalogue</h2><p>Coming soon.</p></div></div>
@endsection
