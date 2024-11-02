<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Algolia\AlgoliaSearch\SearchClient;
use Carbon\Carbon;

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

    public function search3(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('filter');
        $user = $request->input('user');

        $posts = Posts::search($query)
            ->where('categories',$category)
            ->get();

        return response()->json($posts);
    }


    public function search(Request $request){
        $query = $request->input('query');
        $category = $request->input('filter');

        // Initialize the Algolia client with your Algolia credentials
        $client = SearchClient::create(
            config('scout.algolia.id'),
            config('scout.algolia.secret')
        );

        // Set the index name, as defined in your Product model’s searchable index
        $index = $client->initIndex((new  Posts)->searchableAs());

        // Perform the search with facetFilters to match the category
        $results = $index->search($query, [
            'facetFilters' => [
                ['categories:' . $category]
            ],
        ]);
        $items =[];
        foreach($results['hits'] as $hit){
            $item = [...$hit, 'created_at'=> Carbon::parse($hit['created_at'])->diffForHumans()];
            array_push($items, $item);
        }
        return $items;
    }
}
