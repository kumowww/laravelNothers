@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div style="text-align: center; padding: 40px 0;">
    <h1>Welcome to Blog</h1>
    <p style="font-size: 18px; margin: 20px 0; color: #666;">
        Current Language: <strong>{{ strtoupper($locale) }}</strong>
    </p>

    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 20px;">
        <form action="{{ route('index.execute', ['locale' => $locale]) }}" method="POST">
            @csrf
            <input type="hidden" name="code" value="return 'System Check OK';">
            <button type="submit" class="btn">Execute Action</button>
        </form>

        <form action="{{ route('system.clear', ['locale' => $locale]) }}" method="POST">
            @csrf
            <button type="submit" class="btn" style="background: #f44336;">Clear Cache</button>
        </form>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('posts.index', ['locale' => $locale]) }}" class="btn">View Posts</a>
        <a href="{{ route('products.index', ['locale' => $locale]) }}" class="btn" style="margin-left: 10px;">View Products</a>
    </div>
</div>
@endsection