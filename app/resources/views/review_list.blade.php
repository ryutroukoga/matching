@extends('layout.managerlayout')
@section('content')
<main>
    <h1 class="text-center">投稿リスト</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">タイトル</th>
                <th scope="col">違反報告数</th>
                <th scope="col">非表示</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($reviews as $review)
            <tr>
                <td>{{ $review['title'] }}</td>
                <td>{{ $review->violations_count }}</td>
                <form action="{{ route('hide.review', ['reviewdetail'=> $review['id']]) }}" method="POST">
                    @csrf
                    <th scope="row">
                        <button type="submit" class="btn btn-warning btn-sm">非表示</button>
                    </th>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="justiny-content-center">
        {{ $reviews->links() }}
    </div>
</main>
@endsection