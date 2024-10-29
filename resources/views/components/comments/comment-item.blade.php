@props(['comment'=> null, 'post'=> null])
<div class="flex flex-col">
    {{-- main comment --}}
    <x-comments.comment-content :comment="$comment" :post="$post" />
    {{-- reply --}}
    <div class="grid grid-cols-12 mt-8">
        <div class="col-span-1"></div>
        <div class="col-span-11">
            <span>Replies ({{count($comment->replies)}})</span>
            @if (count($comment->replies) > 0)
                @foreach ($comment->replies as $reply)
                    <x-comments.comment-content :comment="$reply" :post="$post" reply />
                @endforeach
            @endif
            <x-comments.reply-form :comment="$comment" :post="$post" />
        </div>
    </div>
</div>
