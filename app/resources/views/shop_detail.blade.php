@extends('layout.layout')
@section('content')
<h1 class="text-center">店舗詳細画面</h1>
<div class="row">
    <div class="col align-self-start">
        <div class="card">
            <div class="card-body">
                <tr>
                    <th scope="col">平均点</th>
                </tr>
            </div>
        </div>
    </div>
    <div class="col align-self-center">
        <div class="card">
            <div class="card-body">
                <table class='table'>
                    <tbody>
                        <tr>
                            <th scope="col">平均点</th>
                        </tr>
                        <tr>
                            <th scope="col">店舗名</th>
                        </tr>
                        <tr>
                            <th scope="col">店舗住所</th>
                        </tr>
                        <tr>
                            <th scope="col">コメント</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="justify-content-center mt-3">
            <a href="" class="col-3 p-3 mb-2 p-3">新規投稿作成</a>
            <a href="" class="col-3 p-3 mb-2 p-3">検索結果画面へ</a>
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
                        <tr>
                            <th scope="col">
                                <a href="">詳細</a>
                            </th>
                            <th scope="col">点数</th>
                            <th scope="col">ユーザー名</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection