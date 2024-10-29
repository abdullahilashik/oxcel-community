@props(['comment'=> null, 'post'=> null, 'reply' => false])
<div class="flex flex-col items-start p-4 rounded shadow bg-white gap-4">
    <div class="flex items-center gap-2">
        <x-user.avatar image="{{$comment->image_path}}" small />
        <div class="flex flex-col">
            <h4 class="font-bold text-xl capitalize text-black">
                @if($reply)
                    {{$comment->user->fname. ' '. $comment->user->lname}}
                @else
                    {{$comment->fname. ' '. $comment->lname}}
                @endif
                @if ($post->uid == $comment->user_id)
                    <span class="badge text-[9px]">author</span>
                @endif
            </h4>
            <span class="text-sm font-light">{{$comment->created_at->diffForHumans()}}</span>
        </div>
    </div>
    <article>{!! $comment->comment !!}</article>
</div>
