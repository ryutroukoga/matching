@extends('layout.shoplayout')
@section('content')
<main>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">詳細</th>
                <th scope="col">ユーザー名</th>
                <th scope="col">点数</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <th scope="col">
                    <a href="{{ route('myshopreviewdetail',['reviewdetail' => $review['id']])  }}">詳細</a>
                </th>
                <th scope="col">{{ $review->user->name }}</th>
                <th scope="col">{{ $review['score'] }}点</th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
</main>
@endsection