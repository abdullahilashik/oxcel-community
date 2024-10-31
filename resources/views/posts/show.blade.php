<x-layout>
    <x-hero :categories="$categories" />
    <x-breadcrumb :links="[['title'=> $post->title,'href'=>'/posts/' . $post->slug]]" />

    <section>
        <div class="container">
            <div class="py-4">
                @if (session('success'))
                    <x-alert.success message="{{session('success')}}" />
                @endif
                @if (session('error'))
                    <x-alert.error message="{{session('error')}}" />
                @endif
            </div>
            {{-- main Post --}}
            <div class="bg-white rounded-md shadow-md p-4">
                {{-- header --}}
                <div class="flex flex-col md:flex-row items-start gap-y-4 md:gap-y-0 md:items-center justify-between border-b-2 border-gray-200 pb-4">
                    {{-- identification --}}
                    <div class="flex items-center gap-2">
                        {{-- user image component --}}
                        <x-user.avatar image="{{$post->image_path}}" :user="$post->user" />

                        <div class="flex flex-col items-start">
                            <h4 class="text-2xl font-bold text-black">{{$post->fname . ' '. $post->lname}}</h4>
                            <span class="text-sm">{{$post->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                    {{-- actions --}}
                    <x-post.post-action :post="$post" />
                </div>
                {{-- content --}}
                <div class="flex flex-col items-start py-4">
                    <h4 class="post-title">{{$post->title}}</h4>
                    <article class="py-4">{!! $post->description !!}</article>
                </div>
                {{-- footer --}}
                <div class="flex flex-col md:flex-row items-start md:items-center md:justify-between">
                    {{-- badges --}}
                    <x-post.badges :categories="$post->categories" />
                    {{-- share --}}
                    <x-social-share />
                </div>
            </div>
            {{-- comment form --}}
            <div class="flex flex-col mt-12">
                <h4 class="post-title">Comments ({{$comments->total()}})</h4>
                <form action="{{route('comment.create')}}" method="post" class="py-8">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="flex items-center gap-4">
                        {{-- <img src="{!! asset('uploads/oxcel.png') !!}" alt="" class="h-16 aspect-square rounded-full"> --}}
                        <x-forms.comment-form />
                    </div>
                    <button class="btn btn-primary ml-auto mt-6 float-right">Post Comment</button>
                    @error('comment')
                        <span class="text-red-600 font-bold">{{$message}}</span>
                    @enderror
                </form>
            </div>
            {{-- comment list --}}
            <div class="mt-5 flex flex-col gap-4">
                {{-- comment item --}}
                @foreach($comments as $comment)
                    <x-comments.comment-item :comment="$comment" :post="$post" />
                @endforeach
            </div>
            {{-- pagination --}}
            @if ($comments)
                <div class="mt-5 pagination-links">
                    {{$comments->links()}}
                </div>
            @endif
        </div>
    </section>
</x-layout>
