@extends('layout.layout')
@section('content')
<main>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1 class="text-center">プロフィール</h1>
    <div class="d-flex justify-content-evenly">
        <div class="col col-md-offset-2 col-md-3">
            <table class='table'>
                <tbody>
                    <tr>
                        <th scope="col">ユーザー名　:　{{ Auth::user()->name }}</th>
                    </tr>
                    <tr>
                        <th scope="col">メールアドレス　:　{{ Auth::user()->email }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="align-self-center">
            <table class='table table-borderless'>
                <tbody>
                    <tr>
                        <th>
                            <a href="{{ route('profileuser') }}">
                                <button type="button" class="btn btn-primary btn-sm">プロフィール編集</button>
                            </a>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <a href="{{ route('userprofile') }}">
                                <button type="button" class="btn btn-primary btn-sm">登録内容編集・退会</button>
                            </a>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <a href="{{ route('book') }}">
                                <button type="button" class="btn btn-primary btn-sm">ブックマーク画面</button>
                            </a>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h5>過去の投稿一覧</h5>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($reviews as $review)
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $review->image) }}" class="card-img-top" alt="画像なし">
                <div class="card-body">
                    <p class="card-text">
                        評価：{{ $review['score'] }}<br>
                        タイトル：{{ $review['title'] }}<br>
                        <a href="{{ route('reviewdetail',['reviewdetail' => $review['id']]) }}">詳細</a>
                        <button class="btn btn-lg bookmark-toggle" data-review-id="{{ $review['id'] }}">
                            @if(auth()->user()->bookmarks()->where('review_id', $review['id'])->exists())
                            <i class="fas fa-star text-warning"></i>
                            @else
                            <i class="far fa-star text-warning"></i>
                            @endif
                        </button>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $reviews->links() }}
    </div>
</main>
@endsection
@push('scripts')
<script>
    var bookmarkUrl = "{{ route('reviews.ajaxlike') }}";
</script>
<script src="{{ asset('js/_ajaxlike.js') }}"></script>
@endpush