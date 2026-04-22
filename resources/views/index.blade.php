@extends('layouts.app')

@section('title', __('messages.home'))

@section('content')
<div class="container">
    <h1>@lang('messages.welcome')</h1>
    
    <p style="font-size: 18px; margin: 20px 0;">
        @lang('messages.current_language'): <strong>{{ strtoupper($locale) }}</strong>
    </p>

    <div class="btn-group">
        <form action="{{ route('system.diagnostics', ['locale' => $locale]) }}" method="POST">
            @csrf
            <button type="submit" class="btn">@lang('messages.system_check')</button>
        </form>

        <form action="{{ route('system.clear', ['locale' => $locale]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">@lang('messages.clear_cache')</button>
        </form>
    </div>
    <div class="btn-group">
        <a href="{{ route('posts.index', ['locale' => $locale]) }}" class="btn">@lang('messages.posts')</a>
        <a href="{{ route('products.index', ['locale' => $locale]) }}" class="btn">@lang('messages.products')</a>
    </div>
</div>
@endsection