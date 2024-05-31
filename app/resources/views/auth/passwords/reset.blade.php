@extends('layout.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <div class="mb-3">
                <h1 class="text-center">パスワード再入力画面</h1>
            </div>
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
            <div class="mb-3">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <label for="email">メールアドレス</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレス入力" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password">新しいパスワード</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="パスワード入力" value="{{ old('password') }}">
            </div>
            <div class="mb-3">
                <label for="password-confirm">新しいパスワード再入力</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="パスワード再度入力" value="{{ old('password_confirmation') }}">
            </div>
            <input type="hidden" name="token" value="{{ $token }}">
        </div>
        <div class="text-center">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">送　信</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection