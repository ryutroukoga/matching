@extends('layout.layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <div class="mb-3">
                <h1 class="text-center">パスワード再設定</h1>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
            <h4 class="text-center">入力いたただいたメールアドレスに、<br>
                再設定用のURLが届きます。<br>
                届いたURLから再度設定を行って下さい。
            </h4>
            <div class="mb-3">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <label for="email">メールアドレス</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレス">
            </div>
        </div>
        <div class="text-center">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">送信</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection