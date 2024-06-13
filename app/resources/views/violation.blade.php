@extends('layout.layout')
@section('content')
<main>
    <h1 class="text-center">違反報告</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col align-self-start">
                <form action="{{ route('violation.report') }}" method="post" onsubmit="return confirmreport()">
                    @csrf
                    <label for='comment' class='mt-2'>コメント入力</label>
                    <textarea class='form-control' name='comment' placeholder="コメントは必須入力ではありません。何かありましたら入力お願いします。" value="{{ old('comment') }}"></textarea>
                    <input type="hidden" name="review_id" value="{{ $detail['id'] }}">
                    <input type="hidden" name="user_id" value="{{ $detail['user_id'] }}">
                    <input type="hidden" name="shop_id" value="{{ $detail['shop_id'] }}">
                    <div class="text-center">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-secondary mt-3">違反報告する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    function confirmreport() {
        return confirm('この投稿を報告しますか？');
    }
</script>
@endsection