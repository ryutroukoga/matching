@extends('layout.layout')
@section('content')
<main>
    <h1 class="text-center">プロフィール</h1>
    <div class="d-flex justify-content-evenly">
        <div class="col col-md-offset-2 col-md-3">
            <table class='table'>
                <tbody>
                    <tr>
                        <th scope="col">ユーザー名:</th>
                    </tr>
                    <tr>
                        <th scope="col">メールアドレス:</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="align-self-center">
            <a href="">・プロフィール編集</a>
            <a href="">・登録内容編集・退会</a><br>
            <a href="">・ブックマーク画面</a>
        </div>
    </div>

    <h5>過去の投稿一覧</h5>
    <div class="d-flex justify-content-evenly">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">点数<br>店舗名<br><a href="">詳細</a></p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">点数<br>店舗名<br><a href="">詳細</a></p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">点数<br>店舗名<br><a href="">詳細</a></p>
            </div>
        </div>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <button type="button" class="btn btn-info">前</button>
        <span>＜１ ２ ３ ４ ５ ＞</span>
        <button type="button" class="btn btn-info">次</button>
    </div>
</main>
@endsection