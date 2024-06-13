@extends('layout.layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <div class="mb-3">
                <h1 class="text-center">店舗アカウント新規登録画面</h1>
            </div>
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
            <form action="{{ route('shop.logincon') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="mb-3">
                        <label for="password">ユーザー名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ユーザー名">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="email">メールアドレス</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="メールアドレス">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="パスワード入力">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password-confirm">パスワード再入力</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="パスワード再度入力">
                </div>
                <div class="text-center">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection