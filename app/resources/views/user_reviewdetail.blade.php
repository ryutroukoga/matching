@extends('layout.layout')
@section('content')
<h1 class="text-center">MYレビュー詳細画面</h1>
<div class="row">
    <div class="col align-self-center">
        <div class="card">
            <div class="card-body">
                <table class='table'>
                    <tbody>
                        <tr>
                            <th scope="col">タイトル：{{ $detail['title'] }}</th>
                        </tr>
                        <tr>
                            <th scope="col">コメント：{{ $detail['comment'] }}</th>
                        </tr>
                        <tr>
                            <th scope="col">評価：{{ $detail['score'] }}点</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col align-self-start">
        <div class="card">
            <div class="card-body">
                <tr>
                    <th scope="col">
                        <img src="{{ $detail['image'] }}" class="img-fluid" alt="レビュー画像">
                    </th>
                </tr>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-evenly mt-3">
        <div class="mb-3">
            <form action="{{ route('delete.review',['reviewdetail' => $detail['id']]) }}" method="post" onsubmit="return confirmDelete()">
                @csrf
                <button type='submit' class="btn btn-danger">投　稿　削　除</button>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('レビュー内容が完全に削除されます。本当に削除しますか？');
    }
</script>
@endsection