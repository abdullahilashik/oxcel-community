@props(['categories'])

<section class="bg-gray-900 text-white w-full">
    <div class="container h-full">
        <div class="flex flex-col  items-center justify-center h-full min-h-[600px] max-w-[820px] mx-auto">
            <h1 class="text-7xl font-bold">Brokers' Community</h1>
            <p class="text-2xl">Discover insights, share expertise, elevate your network</p>
            <form action="#" class="bg-white rounded shadow-md w-full inline-flex items-center justify-between p-3 mt-8 relative">
                <div class="inline-flex items-center gap-1 flex-1">
                    <img src="{!! asset('assets/icons/search.svg') !!}" alt="">
                    <input type="text" placeholder="Search for posts.." class="flex-1 outline-none text-black px-2">
                </div>
                <select name="#" id="#" class="text-black border-l-2 border-gray-900 pl-2 outline-none">
                    <option value="">All Category</option>
                    @if ($categories)
                        @foreach ($categories as $category)
                            <option value="{{$category->slug}}">{{$category->title}}</option>
                        @endforeach
                    @endif
                </select>
                <div class="w-full bg-white border-2 top-[110%] left-0 absolute">
                    <ul class="flex flex-col text-black">
                        <a href="#">
                            <li class="flex flex-col gap-2 hover:bg-gray-100 p-2">
                                <div class="flex items-center justify-between">
                                    <h4>Random post title goes here</h4>
                                    <div class="flex items-center text-[10px] divide-x-2 space-x-4">
                                        <span>Posted by: <span>john doe</span></span>
                                        <span class="pl-4">2 days ago</span>
                                    </div>
                                </div>
                                <p class="text-[10px]">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste, hic in. Veritatis quo nisi possimus quasi. Blanditiis reprehenderit atque dignissimos fugiat. Vero reiciendis officia reprehenderit hic nihil excepturi sequi facilis!</p>
                            </li>
                        </a>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</section>
