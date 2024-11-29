@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav class="card mt-5 nav-card">
            <div class="d-flex justify-content-around">
                <div class="p-2">
                    <img src="{{ asset($user->image) }}" style="width: 100px; height: 100px; object-fit: cover;">
                </div>

                <table>
                    <tbody>
                        <tr>
                            <td>ユーザー名</td>
                            <td>
                                <span>{{ $user->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>メールアドレス</td>
                            <td>
                                <span>{{ $user->email }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>パスワード</td>
                            <td>
                                <span>パスワードは表示できません</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('user.edit') }}" class="d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-warning">編集・退会</button>
                </a>


            </div>

            <hr class="custom-hr">
            <h5>投稿一覧</h5>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($posts as $post)
                <a href="{{ route('requestform.edit', $post->id) }}" class="text-decoration-none">
                    <div class="card">
                        <div class="p-2" style="display: flex; justify-content: center; align-items: center;">
                            <img src="{{ asset($post->image) }}" style="width: 100px; height: 100px; object-fit: cover;" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->detail }}</p>
                            <p class="card-text">{{ $post->status}}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>


            <br>
            <div class="d-flex justify-content-center">
                <a href="{{ route('requestform') }}" class="btn btn-primary">依頼投稿する</a>
            </div>
        </nav>
    </div>
</div>
@endsection