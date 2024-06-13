@extends('layout.shoplayout')
@section('content')
<main>
    <h1 class="text-center">店舗情報</h1>
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
        @endforeach
    </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col align-self-start">
                <form action="{{ route('update.shop',['shopdetail' => $detail['id']]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class='mt-2'>店舗名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="店舗名" value="{{ $detail['name'] }}">
                    </div>
                    <div class="mb-3">
                        <label for='comment' class='mt-2'>コメント入力</label>
                        <textarea class='form-control' name='comment' placeholder="コメント入力">{{ $detail['comment'] }}</textarea>
                    </div>
            </div>
            <div class="col align-self-start">
                <div class="mb-3">
                    <label for="address" class='mt-2'>店舗住所</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="店舗住所" value="{{ $detail['address'] }}">
                </div>
                <div class="mb-3">
                    <label for="formFile" class='mt-2'>画像選択　※特に画像に変更なければ選択しなくて大丈夫です</label>
                    <input class="form-control" type="file" id="formfile" name="formfile">
                </div>
            </div>
            <div class="mb-3">
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">編　集</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</main>
@endsection