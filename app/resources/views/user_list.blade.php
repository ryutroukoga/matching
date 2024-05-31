@extends('layout.managerlayout')
@section('content')
<main>
    <h1 class="text-center">ユーザーリスト</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ユーザー名</th>
                <th scope="col">表示停止数</th>
                <th scope="col">利用停止</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($users as $user)
            <tr>
                <td>{{ $user['name']}}</td>
                <td>{{ $user->reviews_count }}</td>
                <th scope="row">
                    <form action="{{ route('user.down', ['user' => $user['id']]) }}" method="POST">
                        @csrf
                        <button type='submit' class="btn btn-danger btn-sm">利用停止</button>
                    </form>
                </th>
            </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
    <div class="justiny-content-center">
    {{ $users->links() }}
    </div>
</main>
@endsection