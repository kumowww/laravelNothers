@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div>
    <h1>Products</h1>
    <p style="font-size: 16px; color: #666;">Language: <strong>{{ strtoupper($locale) }}</strong></p>
    
    <div style="margin-top: 30px;">
        <p style="color: #999; font-size: 16px;">No products available yet.</p>
    </div>
</div>
@endsection