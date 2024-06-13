@extends('layout.shoplayout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1 class="text-center">店舗専用ページ</h1>
        <div class="text-center">
            <div class="d-grid gap-2 col-6 mx-auto">
                <div class="p-3 text-primary-emphasis bs-success-border-subtle border border-primary-subtle rounded-3">
                    <a href="{{ route('shop.review') }}" class="link-underline-light fw-bold">自店舗レビュー一覧</a>
                </div>
                @if ($shop)
                <div class="p-3 text-primary-emphasis bs-success-border-subtle border border-primary-subtle rounded-3">
                    <a href="{{ route('shop.update') }}" class="link-underline-light fw-bold">店舗編集</a>
                </div>
                @else
                <div class="p-3 text-primary-emphasis bs-success-border-subtle border border-primary-subtle rounded-3">
                    <a href="{{ route('shop.post') }}" class="link-underline-light fw-bold">新規店舗登録</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection