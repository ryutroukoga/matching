@extends('layout.layout')
@section('content')
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<main class="py-4">
    <div class="container text-center">
        <div class="row align-items-start">
            <form action="{{ route('search') }}" method="GET">
                <div class="row g-3">
                    <div class="col-sm-5">
                        @csrf
                        <input class="form-control" type="text" name="keyword" value="" placeholder="店名、住所">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="average_score">
                            <option value="" selected>点数を選択</option>
                            @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="col-sm">
                        <button type="submit" class="btn btn-primary mb-3">さがす</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($reviews as $review)
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text">
                        評価：{{ $review['score'] }}点<br>
                        タイトル：{{ $review['title'] }}<br>
                        コメント：{{ $review['comment'] }}<br>
                        住所：{{ $review->shop['address'] }}<br>
                        <a href="{{ route('shopdetail',['shopdetail' => $review->shop['id']])  }}">詳細</a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $reviews->links() }}
    </div>
</main>
@endsection