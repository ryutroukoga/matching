@extends('layout.layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <div class="mb-3">
                <h1 class="text-center">登録編集</h1>
            </div>
            <div class="mb-3">
                <label for="name">新ユーザー名</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="ユーザー名">
            </div>
            <div class="mb-3">
                <label for="email">新しいメールアドレス入力</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレス">
            </div>
        </div>
        <div class="text-center">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">変更完了</button>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">退　会</button>
            </div>
        </div>
    </div>
</div>

@endsection