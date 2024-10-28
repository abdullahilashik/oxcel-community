@props(['post'=> null])

<form action="{{route('bookmarks.delete', $post->id)}}" class="" method="post">
    @method('delete')
    @csrf
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <button class="text-medium font-bold inline-flex items-center text-sm gap-1 opacity-60 hover:opacity-100 duration-200">
        <img src="{!! asset('assets/icons/bookmark-slash.svg') !!}" alt="" class="w-5">
        <span>{{$post->bookmark_count}}</span>
    </button>
</form>
