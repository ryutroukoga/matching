@extends('layout.layout')
@section('content')
<main>
    <h1 class="text-center">新規投稿作成</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col align-self-start">
                <div class="mb-3">
                    <label for="title" class='mt-2'>タイトル</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="タイトル入力">
                </div>
                <label for='comment' class='mt-2'>コメント入力</label>
                <textarea class='form-control' name='comment'></textarea>
                <div class="col-md-4">
                    <label for='score' class='mt-2'>点数</label>
                    <select class="form-select" aria-label="Default select example">
                        <option value='' hidden>点数</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="col align-self-start">
                <div class="mb-3">
                    <label for="formFile" class='mt-2'>画像選択</label>
                    <input class="form-control" type="file" id="formfile" name="formfile">
                </div>
            </div>
            <div class="text-center">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">作　成</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection