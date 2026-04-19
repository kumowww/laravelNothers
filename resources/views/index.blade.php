@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div style="text-align: center; padding: 40px 0;">
    <h1>Welcome to Blog</h1>
    <p style="font-size: 18px; margin: 20px 0; color: #666;">
        Current Language: <strong>{{ strtoupper($locale) }}</strong>
    </p>

    <div class="grid" style="display: flex; justify-content: center; gap: 20px; margin-top: 30px;">
        <div class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; min-width: 250px;">
            <h3>Index System</h3>
            <p>Status: Active</p>
            <form action="{{ route('index.execute', ['locale' => $locale]) }}" method="POST">
                @csrf
                <button type="submit" class="btn">RUN ALL FILES</button>
            </form>
        </div>

        <div class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; min-width: 250px;">
            <h3>Product Management</h3>
            <p>Models & Migrations</p>
            <a href="{{ route('products.index', ['locale' => $locale]) }}" class="btn">OPEN PRODUCT LIST</a>
        </div>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('posts.index', ['locale' => $locale]) }}" class="btn">View Posts</a>
        <form action="{{ route('system.clear', ['locale' => $locale]) }}" method="POST" style="display: inline-block; margin-left: 10px;">
            @csrf
            <button type="submit" class="btn" style="background-color: #ff4444;">Clear Cache</button>
        </form>
    </div>
</div>
@endsection