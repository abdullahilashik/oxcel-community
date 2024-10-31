@props(['links'=> []])
<section class="mt-5 py-12">
    <div class="container">
        <ul class="inline-flex items-center gap-2">
            <li>
                <a href="{{route('posts')}}"><img src="{!! asset('assets/icons/home.svg') !!}" height="20" width="20" alt=""></a>
            </li>
            <li>
                <img src="{!! asset('assets/icons/arrow-right.svg') !!}" height="10" width="10" alt="">
            </li>
            <li>
                <a href="{{route('posts')}}">Community</a>
            </li>
            @if (isset($links))
                @foreach ($links as $link)
                <li>
                    <img src="{!! asset('assets/icons/arrow-right.svg') !!}" height="10" width="10" alt="">
                </li>
                <li>
                    <a href="{{$link['href']}}">{{$link['title']}}</a>
                </li>
                @endforeach
            @endif
        </ul>
    </div>
</section>
