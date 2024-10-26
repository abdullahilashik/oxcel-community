<section>
    <div class="container">
        <div class="bg-white rounded-md shadow p-4">
            <div class="flex flex-col">
                <a href="{{route('posts.show','oxcel')}}">
                    <h1 class="post-title line-clamp-1">Understanding the process if the client does not proceed with the loan</h1>
                </a>
                {{-- badges --}}
                <x-post.badges />
                {{-- meta data --}}
                <div class="w-full flex items-baseline justify-between mt-5">
                    {{-- content --}}
                    <div class="flex items-center gap-2">
                        <img src="{!! asset('uploads/oxcel.png') !!}" alt="" class="w-12 aspect-square rounded-full">
                        <div class="flex flex-col gap-0 text-sm">
                            <h4 class="font-bold">Oxcel Compliance</h4>
                            <span class="font-light">16 Oct 2024, 05:27 pm, AEST</span>
                        </div>
                    </div>
                    {{-- action --}}
                    <x-post.post-action />
                </div>
            </div>
        </div>
    </div>
</section>
