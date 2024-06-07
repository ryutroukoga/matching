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
                <th scope="row">
                    @if ($review->del_flg == 0)
                    <form action="{{ route('hide.review', ['reviewdetail'=> $review['id']]) }}" method="POST" onsubmit="return confirmhide()">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">非表示</button>
                    </form>
                    @else
                    <form action="{{ route('open.review', ['reviewdetail'=> $review['id']]) }}" method="POST" onsubmit="return confirmopen()">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">再表示</button>
                    </form>
                    @endif
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="justiny-content-center">
        {{ $reviews->links() }}
    </div>
</main>
<script>
    function confirmhide() {
        return confirm('この投稿は非表示になります。非表示にしますか？');
    }

    function confirmopen() {
        return confirm('この投稿は再表示になります。再表示しますか？');
    }
</script>
@endsection