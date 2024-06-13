@extends('layout.shoplayout')
@section('content')
<h1 class="text-center">レビュー詳細画面</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 mb-4">
            <div class="card mx-auto" style="width: 100%;">
                <div class="card-body">
                    <table class='table table-borderless'>
                        <tbody>
                            <tr>
                                <th scope="col">ユーザー名：</th>
                                <td>{{ $user['name'] }}</td>
                            </tr>
                            <tr>
                                <th scope="col">タイトル：</th>
                                <td>{{ $review['title'] }}</td>
                            </tr>
                            <tr>
                                <th scope="col">コメント：</th>
                                <td>{{ $review['comment'] }}</td>
                            </tr>
                            <tr>
                                <th scope="col">評価：</th>
                                <td>{{ $review['score'] }}点</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="card mx-auto" style="width: 100%;">
                <div class="card-body text-center">
                    @if ($review['image'])
                    <img src="{{ asset('storage/' . $review['image']) }}" class="img-fluid img-thumbnail" alt="レビュー画像" style="max-width: 100%; height: auto;">
                    @else
                    <p>画像なし</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-around mt-3">
        <a href="{{ route('shop.review') }}">
            <button type="button" class="btn btn-primary">自店舗レビュー一覧</button>
        </a>
        <a href="{{ route('shop.violation',['reviewdetail' => $review['id']]) }}">
            <button class="btn btn-secondary" type="button">違　反　報　告　す　る</button>
        </a>
    </div>
</div>
@endsection