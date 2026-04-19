@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div style="max-width: 600px;">
    <h1>Create New Post</h1>
    
    <form method="POST" action="/{{ $locale }}/posts" style="margin-top: 30px;">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label for="title" style="display: block; margin-bottom: 8px; font-weight: 500;">Title</label>
            <input type="text" id="title" name="title" required class="form-control" 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 16px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="content" style="display: block; margin-bottom: 8px; font-weight: 500;">Content</label>
            <textarea id="content" name="content" rows="10" required class="form-control"
                      style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 16px; font-family: monospace;"></textarea>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn">Create Post</button>
            <a href="/{{ $locale }}/posts" class="btn btn-secondary" style="text-decoration: none;">Cancel</a>
        </div>
    </form>
</div>
@endsection