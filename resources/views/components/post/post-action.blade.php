@props(['post'=> null])
<div class="flex items-center gap-4">
    {{-- heart --}}
    <x-post.action.favorite :post="$post" />
    {{-- view --}}
    <x-post.action.views :post="$post" />
    {{-- bookmark --}}
    @if ($post->user_id)
        <x-post.action.bookmark-delete :post="$post" />
    @else
        <x-post.action.bookmark :post="$post" />
    @endif
    {{-- share --}}
    <x-post.action.share :post="$post" />
</div>
