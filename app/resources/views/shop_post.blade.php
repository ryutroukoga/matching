@extends('layout.layout')
@section('content')
<main>
    <h1 class="text-center">新規店舗登録</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col align-self-start">
                <div class="mb-3">
                    <label for="title" class='mt-2'>タイトル</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="タイトル入力">
                </div>
                <label for='comment' class='mt-2'>コメント入力</label>
                <textarea class='form-control' name='comment'></textarea>
            </div>
            <div class="col align-self-start">
                <div class="mb-3">
                    <label for="address" class='mt-2'>店舗住所</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="店舗住所">
                </div>
                <div class="mb-3">
                    <label for="formFile" class='mt-2'>画像選択</label>
                    <input class="form-control" type="file" id="formfile" name="formfile">
                </div>
            </div>
            <div class="mb-3">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">作　成</button>
                </div>
            </div>
            <div class="d-md-flex justify-content-md-end">
                <a href="">店舗専用ページへ</a>
            </div>
        </div>
    </div>
</main>
@endsection