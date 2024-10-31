<x-layout>
    <x-hero :categories="$categories" />
    <x-breadcrumb :links="[['title'=> 'Create post','href'=>'#']]" />

    <div class="container">
        @if(session('success'))
            <x-alert.success message="{{session('success')}}"/>
        @endif
        @if(session('error'))
            <x-alert.error message="{{session('error')}}"/>
        @endif
        <form action="{{route('posts.create')}}" class="py-12 flex flex-col gap-y-12" method="post">
            @csrf
            {{-- title --}}
            <div class="flex flex-col items-start bg-green gap-2">
                <label class="text-3xl font-extrabold text-black" for="title">Title</label>
                <input type="text" name="title" class="text-black shadow rounded-md p-6 w-full" placeholder="Add a title to your post"/>
                @error('title')
                    <span class="text-red-600 font-bold">{{$message}}</span>
                @enderror
            </div>
            {{-- description --}}
            <div class="flex flex-col items-start bg-green gap-2">
                <label class="text-3xl font-extrabold text-black" for="title">Description</label>
                {{-- <input type="text" class="text-black shadow rounded-md px-4 py-3 w-full" placeholder="Add a title to your post"/> --}}
                <x-forms.tinymce-editor/>
                @error('description')
                    <span class="text-red-600 font-bold">{{$message}}</span>
                @enderror
            </div>
            {{-- category multi select --}}
            <div class="flex flex-col items-start bg-green gap-2">
                <label class="text-3xl font-extrabold text-black" for="title">Categories</label>
                <div class="w-full grid grid-cols-4 mt-5 gap-6">
                    @foreach ($categories as $category)
                        <label>
                            <input type="checkbox" name="categories[]" value="{{$category->id}}" class="peer sr-only">
                            <div type="button"
                                class="
                                    p-4 bg-white rounded-xl shadow-md text-xl font-bold text-black
                                    peer-checked:bg-gray-900 peer-checked:text-white duration-200
                                    text-center cursor-pointer hover:bg-gray-200">
                                {{$category->title}}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
            <button class="btn btn-primary ml-auto">Create Post</button>
        </form>
    </div>
</x-layout>
