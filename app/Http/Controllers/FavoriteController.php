<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteStoreRequest;
use App\Models\FavoritePost;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index() {}
    public function store(FavoriteStoreRequest $request)
    {
        $validated = $request->validated();
        $favoriteExists = FavoritePost::where("post_id", $validated["post_id"])
            ->where('user_id', Auth::user()->id)->first();
        if ($favoriteExists) {
            return back()->with('error', 'Already in favorite list');
        }
        // add to favorite first
        $favoritePost = FavoritePost::create([
            'user_id' => Auth::user()->id,
            'post_id' => $validated['post_id'],
        ]);
        // update the favorite count in post
        $post = Posts::find($validated['post_id']);
        $post->favorite_count = $post->favorite_count + 1;
        $post->save();
        return back()->with('success', 'Added in your favorite list');
    }
    public function delete($id)
    {

        $favoriteExists = FavoritePost::where("post_id", $id)
            ->where('user_id', Auth::user()->id)->first();

        if ($favoriteExists) {
            $favoriteExists->delete();

            $post = Posts::find($id);
            $post->favorite_count = $post->favorite_count - 1;
            $post->save();

            return back()->with('success', 'Added in your favorite list');
        }
        return back()->with('error', 'Failed to add it to you bookmark');
    }
}
