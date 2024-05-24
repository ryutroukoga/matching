@extends('layout.layout')
@section('content')
<main class="py-4">
    <div class="container text-center">
        <div class="row align-items-start">
            <form action="{{ route('search') }}" method="GET">
                <div class="row g-3">
                    <div class="col-sm-5">
                        @csrf
                        <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="店名、住所">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="average_score">
                            <option value="" selected>点数を選択</option>
                            @for ($i = 1; $i <= 5; $i++) 
                            <option value="{{ $i }}">{{ $i }}</option>
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
        @foreach($shops as $shop)
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="{{  $shop->image ?? 'default-image.jpg' }}" class="card-img-left" alt="...">
                <div class="card-body">
                    <p class="card-text">平均{{ round($shop->average_score, 1) }}点<br>
                        {{ $shop->name }}<br>
                        {{ $shop->address }}<br>
                        <a href="{{ route('shopdetail',['shopdetail' => $shop['id']])  }}">詳細</a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $shops->links() }}
    </div>
</main>
@endsection