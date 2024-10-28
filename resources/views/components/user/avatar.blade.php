@props(['image'=>null, 'small'=> false])

@if ($image)
    <img src="{!! asset($image) !!}" alt="" class="rounded-full {{$small?'w-12':'w-20'}} aspect-square">
@else
    <img src="https://avatar.iran.liara.run/public/1000" alt="" class="rounded-full {{$small?'w-12':'w-20'}} aspect-square">
@endif
