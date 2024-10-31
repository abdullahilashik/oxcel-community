<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    /**
     * Search for posts using keyword and category
     */
    public function search_old(Request $request)
    {
        $keyword = $request->get('query');
        $category = $request->get('filter');
        $sort = $request->get('sort');
        $posts = Posts::search($keyword, $category, $sort);
        // dd($posts);
        return $posts;
    }

    public function searchOld(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('filter');
        $user = $request->input('user'); // Add other filters if necessary

        // Step 1: Search Algolia for matching Post IDs
        $postIds = Posts::search($query)
            ->when($category, function ($query) use ($category) {
                // return $query->where('categories', $category); // Filter posts by category name
                return $query->facetFilter('categories:' . $category);
            })
            ->when($user, function ($query) use ($user) {
                return $query->where('user.name', $user); // Filter by user name
            })
            ->get()
            ->pluck('id'); // Get post IDs

        // Step 2: Retrieve full Post data with relationships from the database
        $posts = Posts::with(['categories', 'user']) // Eager load categories and user
            ->whereIn('id', $postIds)
            ->groupBy('posts.id')
            ->get();

        // return response()->json();
        return [
            ...$posts
        ];
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('filter');
        $user = $request->input('user');

        $posts = Posts::search($query)
            ->when($category, function($query) use ($category){
                return $query->whereIn('categories',$category);
            })
            ->get();

        return response()->json($posts);
    }
}
