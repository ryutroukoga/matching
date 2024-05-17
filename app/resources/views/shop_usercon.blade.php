@extends('layout.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <div class="mb-3">
                <h1 class="text-center">店舗アカウント内容確認</h1>
                <table class='table'>
                    <tbody class="text-center">
                        <tr>
                            <th scope="col">ユーザー名:</th>
                        </tr>
                        <tr>
                            <th scope="col">メールアドレス:</th>
                        </tr>
                        <tr>
                            <th scope="col">パスワード:</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">登　録</button>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-secondary">戻　る</button>
            </div>
        </div>
    </div>
    @endsection