<x-layout>
    <x-hero />
    <x-breadcrumb />
    <x-stats />
    <section id="main" class="">
        <div class="container">
            {{-- create and filter --}}
            <div class="flex itms-center justify-between">
                <a href="#" class="btn btn-primary">Create new Post</a>
                <form class="flex items-center gap-4">
                    <select name="" id=""  class="rounded shadow p-4">
                        <option value="">All Category</option>
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
            <x-post.post-list />
            {{-- pagination --}}
        </div>
    </section>
</x-layout>
