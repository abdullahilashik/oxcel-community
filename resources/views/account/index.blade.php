<x-layout>
    <x-hero />
    <x-breadcrumb />
    <section class="py-12">
        <div class="container">
            <div class="flex items-start gap-4">
                {{-- sidebar --}}
                <div class="w-72 bg-white h-full shadow rounded">
                    <ul class="flex flex-col">
                        <a class="p-4 hover:bg-gray-300 duration-200" href="#">My Account</a>
                        <a class="p-4 hover:bg-gray-300 duration-200" href="#">Edit Information</a>
                        <a class="p-4 hover:bg-gray-300 duration-200" href="#">My Posts</a>
                        <a class="p-4 hover:bg-gray-300 duration-200" href="#">My Comments</a>
                        <a class="p-4 hover:bg-gray-300 duration-200" href="#">Bookmarks</a>
                        <form action="{{route('logout')}}" method="POST" class="w-full">
                            @csrf
                            <button class="p-4 hover:bg-gray-300 duration-200 w-full text-left" type="submit">Logout</button>
                        </form>
                    </ul>
                </div>
                {{-- main container --}}
                <div class="w-full h-full">
                    <div class="bg-white rounded p-4 shadow">
                        <div class="flex flex-col">
                            <h1 class="text-lg font-bold text-black">My Account</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
