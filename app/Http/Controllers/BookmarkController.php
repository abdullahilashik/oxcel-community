<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookmarkCreateRequest;
use App\Models\PostBookmark;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // show all bookmarks in user account
    public function index(){}

    public function store(BookmarkCreateRequest $request){
        $validated = $request->validated();

        $bookmarkExists = PostBookmark::where("user_id", Auth::user()->id)->where("post_id", $request->post_id)->exists();
        if($bookmarkExists){
            return back()->with('error','Bookmark already exists');
        }

        $bookmark = PostBookmark::create([
            ...$validated,
            'user_id' => Auth::user()->id
        ]);

        $post = Posts::find($request->post_id);
        $post->bookmark_count = $post->bookmark_count + 1;
        $post->save();

        return back()->with('success','Bookmark Added');
    }

    // bookmark delete
    public function delete($id){
        $bookmarkExists = PostBookmark::where('user_id', Auth::user()->id)->where('post_id', $id)->exists();

        if($bookmarkExists){
            PostBookmark::where('user_id', Auth::user()->id)->where('post_id', $id)->delete();

            $post = Posts::find($id);
            $post->bookmark_count = $post->bookmark_count - 1;
            $post->save();

            return back()->with('success','Bookmark deleted');
        }
        return back()->with('error','Bookmark was not deleted!');
    }
}
