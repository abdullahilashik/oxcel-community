@props(['comment'=> null, 'post'=> null])

<form action="{{route('comment.reply', $post->id)}}" class="flex flex-col" method="post">
    @csrf
    <input type="hidden" name="comment_id" value="{{$comment->id}}">
    <div class="flex items-center">
        <x-user.avatar />
        <input type="text" name="comment" class="p-4 rounded shadow flex-1 text-black pl-4" placeholder="speak your mind!">
    </div>
    <button class="btn btn-primary ml-auto">Reply</button>
</form>
