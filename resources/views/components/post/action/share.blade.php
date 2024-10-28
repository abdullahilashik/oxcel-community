@props(['post'=> null])

<form action="#" class="">
    <button class="text-medium font-bold inline-flex items-center text-sm gap-1 opacity-60 hover:opacity-100 duration-200">
        <img src="{!! asset('assets/icons/share.svg') !!}" alt="" class="w-5">
        <span>{{$post->share_count}}</span>
    </button>
</form>
