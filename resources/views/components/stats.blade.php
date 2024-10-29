@props(['total_members'=>0,'total_posts'=>0, 'posts_per_month'=>0])
<section class="pb-12 ">
    <div class="container">
        <div class="w-full bg-white rounded-md shadow-md p-12 border-2 border-gray-50">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-around gap-4 md:gap-0">
                {{-- total members --}}
                <div class="flex items-center gap-4">
                    <img src="{!! asset('assets/icons/person.svg') !!}" alt="" height="60" width="60" class="rounded-full bg-gray-200 p-2 flex items-center justify-center">
                    <div class="flex flex-col gap-1">
                        <h2 class="text-3xl font-extrabold text-black">{{$total_members}}</h2>
                        <p>Total Members</p>
                    </div>
                </div>
                {{-- total posts --}}
                <div class="flex items-center gap-4">
                    <img src="{!! asset('assets/icons/posts.svg') !!}" alt="" height="60" width="60" class="rounded-full bg-gray-200 p-2 flex items-center justify-center">
                    <div class="flex flex-col gap-1">
                        <h2 class="text-3xl font-extrabold text-black">{{$total_posts}}</h2>
                        <p>Total Posts</p>
                    </div>
                </div>
                {{-- posts this month --}}
                <div class="flex items-center gap-4">
                    <img src="{!! asset('assets/icons/calendar.svg') !!}" alt="" height="60" width="60" class="rounded-full bg-gray-200 p-2 flex items-center justify-center">
                    <div class="flex flex-col gap-1">
                        <h2 class="text-3xl font-extrabold text-black">{{$posts_per_month}}</h2>
                        <p>Posts This month</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
