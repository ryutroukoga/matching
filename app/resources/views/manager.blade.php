@extends('layout.managerlayout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="text-center">管理者画面</h1>
        <div class="text-center">
            <div class="d-grid gap-2 col-6 mx-auto">
                <div class="p-3 text-primary-emphasis bs-success-border-subtle border border-primary-subtle rounded-3">
                    <a href="{{ route('user.list') }}" class="link-underline-light fw-bold">ユーザーリストへ</a>
                </div>
                <div class="p-3 text-primary-emphasis bs-success-border-subtle border border-primary-subtle rounded-3">
                    <a href="{{ route('review.list') }}" class="link-underline-light fw-bold">投稿リストへ</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection