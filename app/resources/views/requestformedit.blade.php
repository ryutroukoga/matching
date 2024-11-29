@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav class="card mt-5 nav-card">
            <form action="{{ route('request.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-around">
                    <div class="p-2" style="display: flex; justify-content: center; align-items: center;"  class="card-img-top">
                        <img src="{{ asset($post->image) }}" style="width: 200px; height: 200px; object-fit: cover;" class="card-img-top">
                    </div>

                    <table class="table table-bordered narrow-table">
                        <tbody>
                            <tr>
                                <td>タイトル<span class="text-danger">*</span></td>
                                <td><input type="text" name="title" class="form-control uniform-input" value="{{ $post->title }}" required></td>
                            </tr>
                            <tr>
                                <td>金額<span class="text-danger">*</span></td>
                                <td><input type="number" name="amount" class="form-control" value="{{ $post->amount }}" required></td>
                            </tr>
                            <tr>
                                <td>内容<span class="text-danger">*</span></td>
                                <td><textarea name="content" class="form-control" required>{{ $post->detail }}</textarea></td>
                            </tr>
                            <tr>
                                <td>画像</td>
                                <td><input type="file" name="image" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>ステータス</td>
                                <td>
                                    <select name="status" class="form-control" required>
                                        <option value="uplode" {{ $post->status == 'uplode' ? 'selected' : '' }}>掲載中</option>
                                        <option value="move" {{ $post->status == 'move' ? 'selected' : '' }}>進行中</option>
                                        <option value="done" {{ $post->status == 'done' ? 'selected' : '' }}>完了</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">更新する</button>
                </div>
            </form>
        </nav>
    </div>
</div>
@endsection