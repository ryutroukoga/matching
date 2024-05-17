@extends('layout.layout')
@section('content')
<h1 class="text-center">ブックマーク</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">★</th>
            <th scope="col">店舗名</th>
            <th scope="col">住所</th>
            <th scope="col">タイトル</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="col">★</th>
            <th scope="col">店舗名</th>
            <th scope="col">住所</th>
            <th scope="col">タイトル</th>
        </tr>
    </tbody>
</table>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button class="btn btn-primary me-md-2" type="button">前</button>
    <a href="">１</a>
    <button class="btn btn-primary me-md-2" type="button">次</button>
</div>
<div class="text-center">
    <a href="">プロフィール画面へ</a>
</div>
@endsection