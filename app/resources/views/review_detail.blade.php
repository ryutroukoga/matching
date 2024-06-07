@extends('layout.layout')
@section('content')
<h1 class="text-center">レビュー詳細画面</h1>
<div class="row justify-content-center">
    <div class="col-6 align-self-center">
        <div class="card mx-auto" style="width: 80%;">
            <div class="card-body">
                <table class='table'>
                    <tbody>
                        <tr>
                            <th scope="col">ユーザー名：{{ $user['name'] }}</th>
                        </tr>
                        <tr>
                            <th scope="col">タイトル：{{ $review['title'] }}</th>
                        </tr>
                        <tr>
                            <th scope="col">コメント：{{ $review['comment'] }}</th>
                        </tr>
                        <tr>
                            <th scope="col">評価：{{ $review['score'] }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 align-self-start">
        <div class="card mx-auto" style="width: 80%;">
            <div class="card-body text-center">
                <img src="{{ asset('storage/' . $review->image) }}" class="img-fluid" alt="画像なし">
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-evenly mt-3">
    <a href="{{ route('shopdetail', ['shopdetail' => $review['shop_id']]) }}">
        <button type="button" class="btn btn-primary">店　舗　詳　細　へ</button>
    </a>
    <a href="{{ route('violation', ['reviewdetail' => $review['id']]) }}">
        <button class="btn btn-secondary" type="button">違　反　報　告　す　る</button>
    </a>
</div>
@if (session('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
@endif
@endsection