<x-layout>
    <x-hero />
    <x-breadcrumb />

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
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-4">
                    {{-- identification --}}
                    <div class="flex items-center gap-2">
                        {{-- user image component --}}
                        <x-user.avatar image="{{$post->image_path}}" />

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
                <div class="flex items-center justify-between">
                    {{-- badges --}}
                    <x-post.badges :categories="$post->categories" />
                    {{-- share --}}
                    <x-social-share />
                </div>
            </div>
            {{-- comment form --}}
            <div class="flex flex-col mt-12">
                <h4 class="post-title">Comments (0)</h4>
                <form action="#" class="py-8">
                    <div class="flex items-center gap-4">
                        <img src="{!! asset('uploads/oxcel.png') !!}" alt="" class="h-16 aspect-square rounded-full">
                        <input type="text" class="rounded-md p-6 flex-1 text-black" placeholder="Anything you want to add?">
                    </div>
                    <button class="btn btn-primary ml-auto mt-6 float-right">Post Comment</button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
