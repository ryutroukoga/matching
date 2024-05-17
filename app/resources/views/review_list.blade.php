@extends('layout.layout')
@section('content')
<main>
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
                <td>Mark</td>
                <td>Otto</td>
                <th scope="row">
                    <button type="button" class="btn btn-warning">非表示</button>
                </th>
            </tr>
        </tbody>
    </table>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="button" class="btn btn-info">前</button>
    <span>＜１ ２ ３ ４ ５ ＞</span>
    <button type="button" class="btn btn-info">次</button>
    </div>
</main>
@endsection