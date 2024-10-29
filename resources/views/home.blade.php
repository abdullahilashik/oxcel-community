<x-layout>
    <x-hero :categories="$categories" />
    <x-breadcrumb />
    <x-stats total_members="{{$total_members}}" total_posts="{{$total_posts}}" posts_per_month="{{$posts_per_month}}" />
    <section id="main" class="">
        <div class="container">
            {{-- create and filter --}}
            <div class="flex itms-center justify-between">
                <a href="{{route('posts.create')}}" class="btn btn-primary">Create new Post</a>
                <form action="{{route('posts')}}" class="flex items-center gap-4">
                    <select name="filter" onchange="this.form.submit()" id=""  class="rounded shadow p-4">
                        <option value="">All Category</option>
                        @if ($categories)
                            @foreach ($categories as $category)
                                <option value="{{$category->slug}}" {{ request('filter') == $category->slug ? 'selected' : '' }}>
                                    {{$category->title}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <div class="inline-flex items-center bg-white rounded shadow p-4 gap-2">
                        <span class="font-bold">Sort By</span>
                        <select name="sort" onchange="this.form.submit()" id="" class="">
                            <option value="">Sort posts</option>
                            <option {{ request('sort') == 'newest' ? 'selected' : '' }} value="newest">Newest to Oldest</option>
                            <option {{ request('sort') == 'oldest' ? 'selected' : '' }} value="oldest">Oldest to Newest</option>
                            <option {{ request('sort') == 'ascending' ? 'selected' : '' }} value="ascending">A to Z</option>
                            <option {{ request('sort') == 'descending' ? 'selected' : '' }} value="descending">Z to A</option>
                            <option {{ request('sort') == 'trending' ? 'selected' : '' }} value="trending">Most Trending</option>
                            <option {{ request('sort') == 'favorite' ? 'selected' : '' }} value="favorite">Most Favorite</option>
                        </select>
                    </div>
                </form>
            </div>

            @if(count($posts))
                {{-- list --}}
                <x-post.post-list :posts="$posts" />
                {{-- pagination --}}
                <div class="mt-5 pagination-links">
                    {{$posts->links()}}
                </div>
            @else
                <div class="flex flex-col gap-2 mx-auto items-center justify-center">
                    <h1 class="text-5xl font-bold text-black">No Posts Found</h1>
                    <a href="{{route('posts.create')}}" class="underline text-lg">Create new</a>
                </div>
            @endif
        </div>
    </section>
</x-layout>
