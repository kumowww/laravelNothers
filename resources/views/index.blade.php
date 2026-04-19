@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div style="text-align: center; padding: 40px 0;">
    <h1>Welcome to Blog</h1>
    <p style="font-size: 18px; margin: 20px 0; color: #666;">
        Current Language: <strong>{{ strtoupper($locale) }}</strong>
    </p>
    <div style="margin-top: 30px;">
        <a href="/{{ $locale }}/posts" class="btn">View Posts</a>
        <a href="/{{ $locale }}/products" class="btn" style="margin-left: 10px;">View Products</a>
    </div>
</div>
@endsection