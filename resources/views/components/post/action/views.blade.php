@props(['post'=> null])

<form action="#" class="">
    <button type="button" disabled class="text-medium font-bold inline-flex items-center text-sm gap-1">
        <img src="{!! asset('assets/icons/eye.svg') !!}" alt="" class="w-5">
        <span>{{$post->view_count}}</span>
    </button>
</form>
