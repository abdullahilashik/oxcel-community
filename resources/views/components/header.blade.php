<section class="sticky top-0 backdrop-blur-md bg-white z-20 py-4">
    <div class="container">
        <div class="flex items-center justify-between">
            {{-- logo --}}
            <div class="hidden md:inline-flex items-center md:divide-x-2 md:divide-black space-x-4">
                <img src="{!! asset('logo-oxcel.png') !!}" alt="" class="hidden md:block">
                <a href="/"><img src="{!! asset('primary-logo.png') !!}" alt="" class="md:pl-2"></a>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    {{-- actions --}}
                    <a href="{{route('posts')}}" class="title-3">Leaders Panel</a>
                    <a href="{{route('posts.create')}}" class="btn btn-primary">Create new Post</a>
                    {{-- notification icon --}}
                    <div>
                        <span><img src="{!! asset('assets/icons/notification.svg') !!}" height="20px" width="20px" alt=""></span>
                    </div>
                @endauth
                {{-- account dropdown --}}
                <div class="relative group">
                    <div class="inline-flex gap-1">
                        {{-- <img src="{!! asset('uploads/oxcel.png') !!}" class="w-[41px] rounded-full" alt=""> --}}
                        @auth
                            <x-user.avatar image="{{Auth::user()->image_path}}" :user="Auth::user()" small/>
                            {{-- menu --}}
                            <div class="hidden group-hover:block absolute bg-white shadow-md rounded-md w-[200px] -z-10 group-hover:z-10 top-[100%]">
                                <ul class="flex flex-col">
                                    @if(Auth::user())
                                        <a class="font-bold border-b p-2 duration-200 capitalize" href="#">Hi, {{Auth::user()->fname . ' '. Auth::user()->lname}}</a>
                                    @endif
                                    <a class="hover:bg-gray-200 p-2 duration-200" href="{{route('account.index')}}">My account</a>
                                    <a class="hover:bg-gray-200 p-2 duration-200" href="#">Dashboard</a>
                                    <form action="{{route('logout')}}" method="post" class="w-full">
                                        @csrf
                                        <button class="hover:bg-gray-200 p-2 duration-200 w-full text-left">Log out</button>
                                    </form>
                                </ul>
                            </div>
                        @else
                            <a href="{{route('login')}}" class="btn btn-primary">Login</a>
                        @endauth
                        {{-- <button>
                            <img src="{!! asset('assets/icons/arrow-down.svg') !!}" alt="">
                        </button> --}}
                    </div>
                </div>
            </div>
            {{-- <div x-data="{isMobileMenu: false}" class="">
                <button>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                        </svg>
                    </span>
                </button>
                <div class="absolute right-0 top-0 bg-white h-screen w-44 shadow-md">
                    <ul class="flex flex-col">
                        <a href="#" class="p-4 text-left hover:bg-gray-50 duration-200">Create Post</a>
                    </ul>
                </div>
            </div> --}}
        </div>
    </div>
</section>
