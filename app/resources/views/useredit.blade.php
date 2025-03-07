@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="card mt-5">
                <div class="card">
                    <div class="card-title text-center large-text">編集・退会</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="d-flex justify-content-around">
                            <img src="{{ asset($user->image ?? 'https://via.placeholder.com/60') }}" class="user-image">
                        </div>
                        <br>
                        <div class="d-flex justify-content-around">
                            <label for="image" class="col-sm-2 col-form-label no-wrap space">プロフィール画像</label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-around">
                            <label for="name" class="col-sm-2 col-form-label no-wrap space">ユーザー名</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-around">
                            <label for="email" class="col-sm-2 col-form-label no-wrap space">メールアドレス</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <br>
                        <div class="d-grid gap-2 col-3 mx-auto">
                            <button type="submit" class="btn btn-primary">変更する</button>
                        </div>
                    </form>

                    <form action="{{ route('user.delete1') }}" method="POST" class="mt-3">
                        @csrf
                        @method('POST')
                        <div class="d-grid gap-2 col-3 mx-auto">
                            <button type="submit" class="btn btn-danger">退会する</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection