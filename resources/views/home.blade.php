<x-layout>
    <x-hero :categories="$categories" />
    <x-breadcrumb />
    <x-stats total_members="{{$total_members}}" total_posts="{{$total_posts}}" />
    <section id="main" class="">
        <div class="container">
            @if(count($posts))
                {{-- create and filter --}}
                <div class="flex itms-center justify-between">
                    <a href="#" class="btn btn-primary">Create new Post</a>
                    <form class="flex items-center gap-4">
                        <select name="" id=""  class="rounded shadow p-4">
                            <option value="">All Category</option>
                            @if ($categories)
                                @foreach ($categories as $category)
                                    <option value="{{$category->slug}}">{{$category->title}}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="inline-flex items-center bg-white rounded shadow p-4 gap-2">
                            <span class="font-bold">Sort By</span>
                            <select name="" id="" class="">
                                <option value="">Newest to Oldest</option>
                            </select>
                        </div>
                    </form>
                </div>
                {{-- list --}}
                <x-post.post-list :posts="$posts" />
                {{-- pagination --}}
                {{$posts->render()}}
            @else
                <div class="flex flex-col gap-2 mx-auto items-center justify-center">
                    <h1 class="text-5xl font-bold text-black">No Posts Found</h1>
                    <a href="{{route('posts.create')}}" class="underline text-lg">Create new</a>
                </div>
            @endif
        </div>
    </section>
</x-layout>
