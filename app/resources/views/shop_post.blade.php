@extends('layout.shoplayout')
@section('content')
<main>
    <h1 class="text-center">新規店舗登録</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col align-self-start">
                <form action="{{ route('newshop.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class='mt-2'>店舗名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="店舗名">
                    </div>
                    <div class="mb-3">
                        <label for='comment' class='mt-2'>コメント入力</label>
                        <textarea class='form-control' name='comment' placeholder="コメント入力"></textarea>
                    </div>
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
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">作　成</button>
                </div>
            </div>
                </form>
        </div>
    </div>
</main>
@endsection
