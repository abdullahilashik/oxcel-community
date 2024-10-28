@props(['post'=> null])
@php
if ( !function_exists( 'checkBookmarkExists' ) ) {
   function checkBookmarkExists($post ) {
      $exists = false;
      foreach (Auth::user()->bookmarkedPosts as $bookmark) {
        if($bookmark->id == $post->id){
            return true;
        }
      }
      return false;
   }
 }
 @endphp
<div class="flex items-center gap-4">
    {{-- heart --}}
    <x-post.action.favorite :post="$post" />
    {{-- view --}}
    <x-post.action.views :post="$post" />
    {{-- bookmark --}}
    @if(checkBookmarkExists($post))
        <x-post.action.bookmark-delete :post="$post" />
    @else
        <x-post.action.bookmark :post="$post" />
    @endif

    {{-- share --}}
    <x-post.action.share :post="$post" />
</div>
