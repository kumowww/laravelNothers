@extends('layouts.app')

@section('title', __('messages.login'))

@section('content')
<div style="text-align: center; padding: 40px 0;">
    <h1>@lang('messages.login_coming_soon')</h1>
    <p style="font-size: 18px; margin: 20px 0; color: #666;">
        @lang('messages.login_coming_soon_description')
    </p>
    <div style="margin-top: 30px;">
        <a href="{{ route('home', ['locale' => $locale]) }}" class="btn">@lang('messages.back_to_home')</a>
    </div>
</div>
@endsection