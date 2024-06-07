@extends('layout.layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <div class="mb-3">
                <h1 class="text-center">プロフィール編集</h1>
            </div>
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
            <div class="mb-3">
                <form action="{{ route('profileupdate') }}" method="post">
                    @csrf
                    <label for="name">新ユーザー名</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ユーザー名" value="{{ old('name',Auth::user()->name) }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">新しいパスワード</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">パスワード確認</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
        </div>
        <div class="text-center">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">変更完了</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection