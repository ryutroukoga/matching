@extends('layout.layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <div class="mb-3">
                <h1 class="text-center">パスワード再設定</h1>
            </div>
            <h3 class="text-center">入力いたただいたメールアドレスに、<br>
                再設定用のURLが届きます。<br>
                届いたURLから再度設定を行って下さい。
            </h3>
            <div class="mb-3">
                <label for="email">メールアドレス</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレス">
            </div>
        </div>
        <div class="text-center">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">送信</button>
            </div>
        </div>
    </div>
</div>

@endsection