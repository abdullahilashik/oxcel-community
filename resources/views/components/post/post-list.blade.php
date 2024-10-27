@props(['posts'=> []])
<div class="flex flex-col gap-4 mt-5">
    @foreach ($posts as $post)
        <x-post.post-item :post="$post"/>
    @endforeach
</div>
