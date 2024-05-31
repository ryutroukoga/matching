@extends('layout.managerlayout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <div class="mb-3">
                <h1 class="text-center">利用停止確認</h1>
                <h3 class="text-center">このアカウントを利用停止にしますか？</h3>
            </div>
        </div>
    </div>
    <div class="text-center">
        <div class="mb-3">
            <button type="submit" class="btn btn-danger">はい</button>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">いいえ</button>
        </div>
    </div>
</div>
@endsection