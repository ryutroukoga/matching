@extends('layout.layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-offset-3 col-md-6">
            <div class="mb-3">
                <h1 class="text-center">メールアドレス編集・退会</h1>
            </div>
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
            <form action="{{ route('userupdate') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email">新しいメールアドレス入力</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="メールアドレス" value="{{ old('email',Auth::user()->email) }}">
                </div>
        </div>
        <div class="text-center">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">変更完了</button>
                </form>
            </div>

            <div class="mb-3">
                <form action="{{ route('userdelete',['user' => Auth::user()->id]) }}" method="post" onsubmit="return confirmDelete()">
                    @csrf
                    <button type="submit" class="btn btn-danger">退　会</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('本当に削除しますか？この操作は元に戻せません。退会してしまうと登録いただいた情報はすべて削除されます。');
    }
</script>
@endsection