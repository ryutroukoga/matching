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
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['display'] }}</td>
                <th scope="row">
                    @if ($user->stop_flg == 0)
                    <form action="{{ route('user.down', ['user' => $user['id']]) }}" method="POST" onsubmit="return confirmstop()">
                        @csrf
                        <button type='submit' class="btn btn-danger btn-sm">利用停止</button>
                    </form>
                    @else
                    <form action="{{ route('user.up', [$user['id']]) }}" method="POST" onsubmit="return confirmup()">
                        @csrf
                        <button type='submit' class="btn btn-success btn-sm">利用再開</button>
                    </form>
                    @endif
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
<script>
    function confirmstop() {
        return confirm('このユーザーは利用停止になります。本当に停止しますか？');
    }
    function confirmup() {
        return confirm('このユーザーは利用再開になります。本当に再開しますか？');
    }
</script>
@endsection