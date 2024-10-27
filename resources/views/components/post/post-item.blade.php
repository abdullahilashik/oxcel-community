@props(['post'=> null])
<section>
    <div class="container">
        <div class="bg-white rounded-md shadow p-4">
            <div class="flex flex-col">
                <a href="{{route('posts.show',$post->slug)}}">
                    <h1 class="post-title line-clamp-1">{{$post->title}}</h1>
                </a>
                {{-- badges --}}
                <x-post.badges :categories="$post->categories" />
                {{-- meta data --}}
                <div class="w-full flex items-baseline justify-between mt-5">
                    {{-- content --}}
                    <div class="flex items-center gap-2">
                        <img src="{!! asset('uploads/oxcel.png') !!}" alt="" class="w-12 aspect-square rounded-full">
                        <div class="flex flex-col gap-0 text-sm">
                            <h4 class="font-bold">{{$post->fname.' '.$post->lname}}</h4>
                            <span class="font-light">{{$post->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                    {{-- action --}}
                    <x-post.post-action :post="$post" />
                </div>
            </div>
        </div>
    </div>
</section>
