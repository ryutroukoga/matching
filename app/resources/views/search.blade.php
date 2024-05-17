@extends('layout.layout')
@section('content')
<main class="py-4">
    <div class="container text-center">
        <div class="row align-items-start">
            <form>
                <div class="row g-3">
                    <div class="col-sm-5">
                        <input type="text" class="form-control" placeholder="店舗名、地域など">
                    </div>

                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example">
                            <option value='' hidden>点数</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <button type="submit" class="btn btn-primary mb-3">さがす</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-evenly">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">平均点<br>店舗名<br>店舗住所<br><a href="">詳細</a></p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">平均点<br>店舗名<br>店舗住所<br><a href="">詳細</a></p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">平均点<br>店舗名<br>店舗住所<br><a href="">詳細</a></p>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-evenly">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">平均点<br>店舗名<br>店舗住所<br><a href="">詳細</a></p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">平均点<br>店舗名<br>店舗住所<br><a href="">詳細</a></p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">平均点<br>店舗名<br>店舗住所<br><a href="">詳細</a></p>
            </div>
        </div>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="button" class="btn btn-info">前</button>
        <span>＜１ ２ ３ ４ ５ ＞</span>
        <button type="button" class="btn btn-info">次</button>
    </div>
</main>
@endsection