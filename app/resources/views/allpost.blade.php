@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav class="card mt-5 nav-card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">投稿タイトル</th>
                        <th scope="col">ユーザー詳細</th>
                        <th scope="col">違反投稿件数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr onclick="window.location='{{ route('kanripost.detail', $post->id) }}'">
                        <td>{{ $post->title }}</td>
                        <td><a href="{{ route('user.detail', $post->users->id) }}">{{ $post->users->name }}</a></td>
                        <td>{{ $post->dangers_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- ページネーション -->
            <div class="d-flex justify-content-center mt-3">
                {{ $posts->links() }}
            </div>
        </nav>
    </div>
</div>
@endsection