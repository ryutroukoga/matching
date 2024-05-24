@extends('layout.layout')
@section('content')
<main>
    <h1 class="text-center">新規投稿作成</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col align-self-start">
                <div class="mb-3">
                    <form action="{{ route('post') }}" method="post">
                        @csrf
                        <label for="title" class='mt-2'>タイトル</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="タイトル入力" value="{{ old('title') }}">
                </div>
                <label for='comment' class='mt-2'>コメント入力</label>
                <textarea class='form-control' name='comment' value="{{ old('comment') }}"></textarea>
                <div class="col-md-4">
                    <label for='score' class='mt-2'>点数(１~５で入力)</label>
                    <input type="number" class="form-control" min="1" max="5" name="score" placeholder="点数" value="{{ old('score') }}">
                </div>
            </div>
            <div class="col align-self-start">
                <div class="mb-3">
                    <label for="formFile" class='mt-2'>画像選択</label>
                    <input class="form-control" type="file" id="formfile" name="image">
                </div>
            </div>
            <input type="hidden" name="shop_id" value="{{ $details['id'] }}">
            <div class="text-center">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">作　成</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</main>
@endsection