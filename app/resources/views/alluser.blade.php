@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav class="card mt-5 nav-card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ユーザー詳細</th>
                        <th scope="col">投稿件数</th>
                        <th scope="col">表示停止件数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td><a href="{{ route('user.detail', $user->id) }}">{{ $user['name'] }}</a></td>
                        <td>{{ $user->posts_count }}</td>
                        <td>{{ $user->stopped_posts_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- ページネーション -->
            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
            </div>
        </nav>

    </div>
</div>
@endsection