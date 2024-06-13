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
                                <button type="button" class="btn btn-primary btn-sm">メールアドレス編集・退会</button>
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
                <img src="{{ asset('storage/' . $review->image) }}" class="card-img-top img-fluid img-thumbnail" alt="画像なし">
                <div class="card-body">
                    <input type="hidden" class="review-id" value="{{ $review['id'] }}">
                    <p class="card-text">
                        評価：{{ $review['score'] }}<br>
                        タイトル：{{ $review['title'] }}<br>
                        <a href="{{ route('reviewdetail',['reviewdetail' => $review['id']]) }}">詳細</a>
                        <button type="button" class="btn bookmark-btn {{ $review->bookmarked ? 'bookmarked' : '' }}">
                            <i class="bi {{ $review->bookmarked ? 'bi-star-fill' : 'bi-star' }}"></i>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(function() {
        $('.bookmark-btn').click(function() {
            const review_id = $(this).closest('.card-body').find('.review-id').val();
            const button = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("ajaxlike") }}',
                type: 'POST',
                data: {
                    'review_id': review_id
                },
                success: function(data) {
                    if (data.bookmarked) {
                        button.addClass('bookmarked').find('i').removeClass('bi-star').addClass('bi-star-fill');
                    } else {
                        button.removeClass('bookmarked').find('i').removeClass('bi-star-fill').addClass('bi-star');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('エラー: ' + error);
                }
            });
        });
    });
</script>