@props(['comment'=> null, 'post'=> null])
<div class="flex flex-col">
    {{-- main comment --}}
    <x-comments.comment-content :comment="$comment" :post="$post" />
    {{-- reply --}}
    <div class="grid grid-cols-12 mt-8">
        <div class="col-span-1"></div>
        {{-- <div class="col-span-11">
            <span>Replies (0)</span>
            <x-comments.comment-content />
            <x-comments.reply-form />
        </div> --}}
    </div>
</div>
