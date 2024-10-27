@props(['categories'=>[]])

<ul class="inline-flex items-center gap-1 flex-wrap flex-1">
    @foreach ($categories as $category)
        <li class="badge">{{$category->title}}</li>
    @endforeach
</ul>
