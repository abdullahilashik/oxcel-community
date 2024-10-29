@props(['image' => null, 'user' => null, 'small' => false])

@php
    if (!function_exists('getUserBadge')) {
        function getUserBadge($user)
        {
            $trophy = \App\Models\BrokerTrophy::orderBy('threshold','desc')->where('threshold','<=',count($user->comments))->pluck('slug');
            if($trophy){
                return $trophy[0];
            }
            return null;
        }
    }
@endphp

<div class="relative">
    @if ($user && getUserBadge($user))
        <span
            class="absolute w-6 h-6 bg-gray-900 text-white -right-0 -bottom-0 rounded-full shadow flex justify-center items-center">
            <img src="{!! asset('assets/trophy/'.getUserBadge($user).'.png') !!}" alt="" class="object-cover">
        </span>
    @endif
    @if ($image)
        <img src="{!! asset($image) !!}" alt="" class="rounded-full {{ $small ? 'w-12' : 'w-20' }} aspect-square">
    @else
        <img src="https://avatar.iran.liara.run/public/1000" alt=""
            class="rounded-full {{ $small ? 'w-12' : 'w-20' }} aspect-square">
    @endif
</div>
