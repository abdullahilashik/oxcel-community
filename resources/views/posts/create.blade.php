<x-layout>
    <x-hero />
    <x-breadcrumb />

    <div class="container">
        <form action="#" class="py-12 flex flex-col gap-y-12">
            {{-- title --}}
            <div class="flex flex-col items-start bg-green gap-2">
                <label class="text-3xl font-extrabold text-black" for="title">Title</label>
                <input type="text" class="text-black shadow rounded-md p-6 w-full" placeholder="Add a title to your post"/>
            </div>
            {{-- description --}}
            <div class="flex flex-col items-start bg-green gap-2">
                <label class="text-3xl font-extrabold text-black" for="title">Description</label>
                {{-- <input type="text" class="text-black shadow rounded-md px-4 py-3 w-full" placeholder="Add a title to your post"/> --}}
                <x-forms.tinymce-editor/>
            </div>
            {{-- category multi select --}}
            <div class="flex flex-col items-start bg-green gap-2">
                <label class="text-3xl font-extrabold text-black" for="title">Categories</label>
                <input type="text" class="text-black shadow rounded-md p-6 w-full" placeholder="Add a title to your post"/>
            </div>
            <button class="btn btn-primary ml-auto">Create Post</button>
        </form>
    </div>
</x-layout>
