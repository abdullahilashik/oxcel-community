@props(['post' => null])

@php
    if ( !function_exists( 'checkFavoriteExists' ) ) {
    function checkFavoriteExists($post ) {
        $exists = false;
        foreach (Auth::user()->favoritePosts as $favorite) {
            if($favorite->id == $post->id){
                return true;
            }
        }
        return false;
    }
    }
@endphp

@if (checkFavoriteExists($post))
    <form action="{{ route('favorite.delete',$post->id) }}" method="post" class="">
        @method('delete')
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <button
            class="text-medium font-bold inline-flex items-center text-sm gap-1 opacity-60 hover:opacity-100 duration-200">
            <img src="{!! asset('assets/icons/heart-fill.svg') !!}" alt="" class="w-5">
            <span>{{ $post->favorite_count }}</span>
        </button>
    </form>
@else
    <form action="{{ route('favorite.create') }}" method="post" class="">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <button
            class="text-medium font-bold inline-flex items-center text-sm gap-1 opacity-60 hover:opacity-100 duration-200">
            <img src="{!! asset('assets/icons/heart.svg') !!}" alt="" class="w-5">
            <span>{{ $post->favorite_count }}</span>
        </button>
    </form>
@endif
