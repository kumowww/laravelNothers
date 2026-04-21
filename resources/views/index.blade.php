@extends('layouts.app')

@section('title', __('messages.home'))

@section('content')
<div style="text-align: center; padding: 40px 0;">
    <h1>@lang('messages.welcome')</h1>
    <p style="font-size: 18px; margin: 20px 0; color: #666;">
        @lang('messages.current_language'): <strong>{{ strtoupper($locale) }}</strong>
    </p>

    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <form action="{{ route('index.execute', ['locale' => $locale]) }}" method="POST">
            @csrf
            <input type="hidden" name="code" value="return 'System Check OK';">
            <button type="submit" class="btn">@lang('messages.execute_action')</button>
        </form>

        <form action="{{ route('system.clear', ['locale' => $locale]) }}" method="POST">
            @csrf
            <button type="submit" class="btn" style="background: #f44336;">@lang('messages.clear_cache')</button>
        </form>
    </div>

    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <a href="{{ route('posts.index', ['locale' => $locale]) }}" class="btn" style="min-width: 150px;">@lang('messages.view_posts')</a>
        <a href="{{ route('products.index', ['locale' => $locale]) }}" class="btn" style="min-width: 150px;">@lang('messages.view_products')</a>
    </div>
</div>
@endsection