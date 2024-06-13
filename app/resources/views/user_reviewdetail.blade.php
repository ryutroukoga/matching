@extends('layout.layout')
@section('content')
<h1 class="text-center">MYレビュー詳細画面</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 mb-4">
            <div class="card mx-auto" style="width: 100%;">
                <div class="card-body">
                    <table class='table table-borderless'>
                        <tbody>
                            <tr>
                                <th scope="col">タイトル：</th>
                                <td>{{ $detail['title'] }}</td>
                            </tr>
                            <tr>
                                <th scope="col">コメント：</th>
                                <td>{{ $detail['comment'] }}</td>
                            </tr>
                            <tr>
                                <th scope="col">評価：</th>
                                <td>{{ $detail['score'] }}点</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="card mx-auto" style="width: 100%;">
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $detail->image) }}" class="img-fluid img-thumbnail" alt="レビュー画像" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-around mt-3">
        <div class="mb-3">
            <form action="{{ route('delete.review',['reviewdetail' => $detail['id']]) }}" method="post" onsubmit="return confirmDelete()">
                @csrf
                <button type='submit' class="btn btn-danger">投　稿　削　除</button>
            </form>
        </div>
        <div class="mb-3">
            <a href="{{ route('update',['reviewdetail' => $detail['id']]) }}">
                <button type="button" class="btn btn-success">投　稿　編　集</button>
            </a>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('レビュー内容が完全に削除されます。本当に削除しますか？');
        }
    </script>
    @endsection