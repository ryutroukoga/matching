@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav class="card mt-5 nav-card">
            <div class="d-flex mb-3">
                <div class="p-2">
                    <img src="{{ asset($users->image) }}" style="width: 100px; height: 100px; object-fit: cover;"  class="card-img-top">
                </div>
                <div class="p-2 large-text">{{ $users->name }}</div>
                <div class="ms-auto p-2">
                    <form action="{{ route('user.stop', $users->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当にユーザーを利用停止にしますか？')">ユーザー利用停止</button>
                    </form>
                </div>
            </div>

            <br>
            <table class="table table-hover">
                <thead>
                    <h4>投稿一覧</h4>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">タイトル</th>
                        <th scope="col">内容</th>
                        <th scope="col">金額</th>
                        <th scope="col">報告数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users->posts as $post)
                    <tr onclick="window.location='{{ route('kanripost.detail', $post->id) }}'">
                        <td><img src="{{ asset($post->image) }}" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $post->users->name }}" class="user-image"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->detail }}</td>
                        <td>{{ $post->amount }}</td>
                        <td>{{ $post->dangers_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </nav>
    </div>
</div>
@endsection