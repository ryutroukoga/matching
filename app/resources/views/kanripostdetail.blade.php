@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav class="card mt-5 nav-card">
            <div class="card text-center">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="large-text">{{ $post->title }}</div>
                    <div class="d-flex align-items-center">
                        <div class="status me-2">{{ $post->status }}</div>
                    </div>
                </div>
                <div class="card-body d-flex align-items-start">
                    <div class="p-2">
                        <img src="{{ asset($post->image) }}" style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $post->users->name }}" class="user-image"></td>
                    </div>
                    <div class="ms-3">
                        <p class="card-text">{{ $post->amount }}</p>
                        <p class="card-text">{{ $post->detail }}</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-evenly">
                <a href="{{ url()->previous() }}" class="btn btn-primary">戻る</a>
                <a href="{{ route('kanripost.stop', $post->id) }}" class="btn btn-danger">表示停止する</a>
            </div>
        </nav>
    </div>
</div>

@endsection