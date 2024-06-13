@extends('layout.layout')
@section('content')
<h1 class="text-center">ブックマーク</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col" class="bookmark-btn bookmarked">★</th>
            <th scope="col">店舗名</th>
            <th scope="col">住所</th>
            <th scope="col">タイトル</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookmarkedReviews as $review)
        <tr>
            <td scope="col" class="bookmark-btn bookmarked">★</td>
            <td>{{ $review->shop->name }}</td>
            <td>{{ $review->shop->address }}</td>
            <td>{{ $review->title }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection