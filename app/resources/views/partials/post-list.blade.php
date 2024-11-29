@foreach($posts as $post)
<tr onclick="location.href='{{ route('post.all', ['id' => $post['id']]) }}'" style="cursor: pointer;">
    <td> <img src="{{ asset($post->image) }}" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $post->users->name }}" class="user-image"></td>
    <td>{{ $post['title'] }}</td>
    <td>{{ $post['detail'] }}</td>
    <td>{{ $post['amount'] }}</td>
    <td>{{ $post['status'] }}</td>
</tr>
@endforeach