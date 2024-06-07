@extends('layout.layout')
@section('content')
<h1 class="text-center">店舗詳細画面</h1>
<div class="row">
    <div class="col align-self-start">
        <div class="card">
            <img src="{{ asset('storage/' . $detail->image) }}" class="img-thumbnail" alt="店舗画像">
        </div>
    </div>
    <div class="col align-self-center">
        <div class="card">
            <div class="card-body">
                <table class='table'>
                    <tbody>
                        <tr>
                            <th scope="col">評価：平均{{ round($averageScore, 1) }}点</th>
                        </tr>
                        <tr>
                            <th scope="col">店舗名：{{ $detail['name'] }}</th>
                        </tr>
                        <tr>
                            <th scope="col">住所：{{ $detail['address'] }}</th>
                        </tr>
                        <tr>
                            <th scope="col">店舗コメント：{{ $detail['comment'] }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('newreview',['shopdetail' => $detail['id']]) }}" class="col-3 p-3 mb-2 p-3">
                <button type="button" class="btn btn-primary btn-lg">新規投稿作成</button>
            </a>
        </div>
    </div>
    <div class="col align-self-start">
        <div class="card">
            <div class="card-header">
                <div class='text-center'>レビュー一覧</div>
            </div>
            <div class="card-body">
                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col'>詳細</th>
                            <th scope='col'>点数</th>
                            <th scope='col'>ユーザー名</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <th scope="col">
                                <a href="{{ route('review_detail',['reviewdetail' => $review['id']])  }}">詳細</a>
                            </th>
                            <th scope="col">{{ $review['score'] }}</th>
                            <th scope="col">{{ $review->user->name }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if (session('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
@endif
@endsection