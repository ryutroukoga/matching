@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav class="card mt-5 nav-card">
            <form action="{{ route('search') }}" method="POST" class="d-flex flex-wrap gap-2 justify-content-center align-items-center">
                @csrf
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" placeholder="キーワード" value="{{ old('keyword') }}">
                </div>
                <div class="form-group d-flex align-items-center">
                    <select name="min_amount" class="form-control">
                        <option value="" hidden>最低金額</option>
                        <option value="1000" {{ old('min_amount') == '1000' ? 'selected' : '' }}>1000</option>
                        <option value="2000" {{ old('min_amount') == '2000' ? 'selected' : '' }}>2000</option>
                        <option value="3000" {{ old('min_amount') == '3000' ? 'selected' : '' }}>3000</option>
                        <option value="4000" {{ old('min_amount') == '4000' ? 'selected' : '' }}>4000</option>
                    </select>
                    <p class="mb-0 mx-2">円</p>
                    <p class="mb-0 mx-2">～</p>
                    <select name="max_amount" class="form-control">
                        <option value="" hidden>最高金額</option>
                        <option value="1000" {{ old('max_amount') == '1000' ? 'selected' : '' }}>1000</option>
                        <option value="2000" {{ old('max_amount') == '2000' ? 'selected' : '' }}>2000</option>
                        <option value="3000" {{ old('max_amount') == '3000' ? 'selected' : '' }}>3000</option>
                        <option value="4000" {{ old('max_amount') == '4000' ? 'selected' : '' }}>4000</option>
                    </select>
                    <p class="mb-0 mx-2">円</p>
                </div>
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="" hidden>ステータス</option>
                        <option value="uplode" {{ old('status') == 'uplode' ? 'selected' : '' }}>掲載中</option>
                        <option value="move" {{ old('status') == 'move' ? 'selected' : '' }}>進行中</option>
                        <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>完了</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-0">検索</button>
            </form>


            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>タイトル</th>
                        <th>内容</th>
                        <th>金額</th>
                        <th>ステータス</th>
                    </tr>
                </thead>
                <tbody id="post-list">
                    @foreach($posts as $post)
                    <tr onclick="location.href='{{ route('post.all', ['id' => $post['id']]) }}'" style="cursor: pointer;">
                        <td> <img src="{{ asset($post->image) }}" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $post->users->name }}" class="user-image"></td>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['detail'] }}</td>
                        <td>{{ $post['amount'] }}</td>
                        <td>{{ $post['status'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- 無限スクロール、TOPへ戻るボタン実装予定 -->
            <!-- ローディングインジケーター -->
            <div id="loading" style="display: none;">読み込み中...</div>
        </nav>
    </div>
</div>

<!-- トップに戻るボタン -->
<button id="back-to-top" class="btn btn-primary" style="display: none; position: fixed; bottom: 30px; right: 30px; border-radius: 50%; width: 60px; height: 60px; font-size: 16px; text-align: center; line-height: 45px; background-color: #007bff; color: white; border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: background-color 0.3s ease;">
    ↑
</button>

<script>
    let page = 1;
    let loading = false;

    window.addEventListener('scroll', function() {
        if (loading) return;

        if (window.innerHeight + window.scrollY >= document.body.scrollHeight - 100) {
            loading = true;
            document.getElementById('loading').style.display = 'block'; // ローディング表示

            let searchParams = new URLSearchParams({
                page: page + 1,
                keyword: document.querySelector('[name="keyword"]').value,
                min_amount: document.querySelector('[name="min_amount"]').value,
                max_amount: document.querySelector('[name="max_amount"]').value,
                status: document.querySelector('[name="status"]').value
            });

            fetch('{{ route("loadMorePosts") }}?' + searchParams.toString())
                .then(response => response.json())
                .then(data => {
                    if (data.posts.length > 0) {
                        document.getElementById('post-list').innerHTML += data.posts;
                        page++; // ページ番号をインクリメント
                    } else {
                        document.getElementById('loading').style.display = 'none';
                    }

                    if (!data.hasMore) {
                        window.removeEventListener('scroll', arguments.callee);
                        document.getElementById('loading').style.display = 'none';
                    }

                    loading = false;
                })
                .catch(() => {
                    loading = false;
                    document.getElementById('loading').style.display = 'none';
                });
        }
    });


    // スクロールイベントでトップに戻るボタンを表示
    window.addEventListener('scroll', function() {
        const backToTopButton = document.getElementById('back-to-top');
        // 300px以上スクロールしたら表示
        if (window.scrollY > 300) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    });

    // トップに戻るボタンがクリックされたときにページをトップにスクロール
    document.getElementById('back-to-top').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
@endsection