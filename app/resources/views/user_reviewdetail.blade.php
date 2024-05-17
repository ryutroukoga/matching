@extends('layout.layout')
@section('content')
<h1 class="text-center">MYレビュー詳細画面</h1>
<div class="row">
    <div class="col align-self-center">
        <div class="card">
            <div class="card-body">
                <table class='table'>
                    <tbody>
                        <tr>
                            <th scope="col">ユーザー名</th>
                        </tr>
                        <tr>
                            <th scope="col">タイトル</th>
                        </tr>
                        <tr>
                            <th scope="col">コメント</th>
                        </tr>
                        <tr>
                            <th scope="col">点数</th>
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
                    <th scope="col">画像</th>
                </tr>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-secondary" type="button">違　反　報　告　す　る</button>
        <a href="">店舗詳細画面へ</a>
    </div>
</div>
@endsection