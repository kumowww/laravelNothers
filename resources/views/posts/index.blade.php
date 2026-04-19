@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div>
    <h1>Posts</h1>
    <a href="/{{ $locale }}/posts/create" class="btn">Create New Post</a>
    
    <div style="margin-top: 30px;">
        <p style="color: #999; font-size: 16px;">No posts yet. Create your first post! 0_0</p>
    </div>
</div>
@endsection