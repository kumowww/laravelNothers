@extends('layouts.app')

@section('title', __('messages.products'))

@section('content')
<div style="text-align: center; padding: 40px 0;">
    <h1>@lang('messages.products_under_development')</h1>
    <p style="font-size: 18px; margin: 20px 0; color: #666;">
        @lang('messages.products_under_development_description')
    </p>
    <div style="margin-top: 30px;">
        <a href="{{ route('home', ['locale' => $locale]) }}" class="btn">@lang('messages.back_to_home')</a>
    </div>
</div>
@endsection