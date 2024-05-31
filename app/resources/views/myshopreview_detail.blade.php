@extends('layout.shoplayout')
@section('content')
<h1 class="text-center">レビュー詳細画面</h1>
<div class="row">
    <div class="col align-self-center">
        <div class="card">
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
    <div class="col align-self-start">
        <div class="card">
            <div class="card-body">
                <tr>
                    <th scope="col">{{ $review['image'] }}</th>
                </tr>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-evenly mt-3">
        <a href="{{ route('shop.violation',['reviewdetail' => $review['id']]) }}">
            <button class="btn btn-secondary" type="button">違　反　報　告　す　る</button>
        </a>
    </div>
</div>
@endsection