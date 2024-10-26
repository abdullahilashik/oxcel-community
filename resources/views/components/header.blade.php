<section class="sticky top-0 backdrop-blur-md bg-white z-20 py-4">
    <div class="container">
        <div class="flex items-center justify-between">
            {{-- logo --}}
            <div class="flex items-center divide-x-2 divide-black space-x-4">
                <img src="{!! asset('logo-oxcel.png') !!}" alt="">
                <a href="/"><img src="{!! asset('primary-logo.png') !!}" alt="" class="pl-2"></a>
            </div>
            <div class="flex items-center gap-4">
                {{-- actions --}}
                <a href="#" class="title-3">Leaders Panel</a>
                <a href="{{route('posts.create')}}" class="btn btn-primary">Create new Post</a>
                {{-- notification icon --}}
                <div>
                    <span><img src="{!! asset('assets/icons/notification.svg') !!}" height="20px" width="20px" alt=""></span>
                </div>
                {{-- account dropdown --}}
                <div class="relative group">
                    <div class="inline-flex gap-1">
                        <img src="{!! asset('uploads/oxcel.png') !!}" class="w-[41px] rounded-full" alt="">
                        {{-- <button>
                            <img src="{!! asset('assets/icons/arrow-down.svg') !!}" alt="">
                        </button> --}}
                    </div>
                    {{-- menu --}}
                    <div class="hidden group-hover:block absolute bg-white shadow-md rounded-md w-[200px] -z-10 group-hover:z-10">
                        <ul class="flex flex-col">
                            <a class="hover:bg-gray-200 p-2 duration-200" href="#">My account</a>
                            <a class="hover:bg-gray-200 p-2 duration-200" href="#">Dashboard</a>
                            <form action="" class="w-full">
                                <button class="hover:bg-gray-200 p-2 duration-200 w-full text-left" href="#">Log out</button>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
