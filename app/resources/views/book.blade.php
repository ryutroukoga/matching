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
        @foreach($bookmarkedReviews as $review)
        <tr>
            <td><button class="btn btn-link bookmark-toggle" data-review-id="{{ $review->id }}">
                    <i class="fas fa-star text-warning"></i></button></td>
            <td>{{ $review->shop_name }}</td>
            <td>{{ $review->address }}</td>
            <td>{{ $review->title }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection