<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\FavoritePost;
use App\Models\PostBookmark;
use App\Models\PostCategoryRel;
use App\Models\Posts;
use Illuminate\Http\Request;
use Algolia\AlgoliaSearch\SearchClient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Str;
class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $request->get('filter');
        $sort = $request->get('sort');
        $keyword = $request->get('query');

        $posts = Posts::searchPost($keyword, $category, $sort , 10);
        foreach($posts as $post) {
            $post->created_parsed = $post->created_at->diffForHumans();
        }
        return response()->json($posts);
    }

    public function store(PostCreateRequest $request){
        $data = $request->validated();
        $post = Posts::create([
            ...$data,
            'slug'=> Str::slug($data['title'],'-'),
            'user_id' => $request->user()->id,
        ]); // create post
        $categories = [];
        foreach($request->categories as $category){
            $temp = [
                'post_id'=>$post->id,
                'post_category_id' => $category
            ];
            array_push($categories, $temp);
        }
        PostCategoryRel::insert($categories);
    }

    // search for posts with auto complete
    public function searchAutoComplete(Request $request){
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


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Posts::GetPostBySlug($slug);
        return $post;
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

    public function stats(){
        $totalMembers = User::count();
        $totalPosts = Posts::count();
        $postsCount = Posts::whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year)
                  ->count();
        return [
            'total_members' => $totalMembers,
            'total_posts' => $totalPosts,
            'total_posts_month' => $postsCount
        ];
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

    // increase view button
    public function postView(Posts $post){
        $post->view_count = $post->view_count + 1;
        $post->save();
        return response()->json([
            "message" => "View increased",
            "errors" => false,
            "exception" => false
        ]);
    }
    // toggle bookmark
    // toggle favorite
    public function favoriteToggle(Request $request, Posts $post){
        $isFavorite = FavoritePost::where('post_id',$post->id)->where('user_id', $request->user()->id)->exists();
        if($isFavorite){
            FavoritePost::where('post_id',$post->id)->where('user_id', $request->user()->id)->delete();
            $post->favorite_count = $post->favorite_count - 1;
            $post->save();
            return [
                "success" => false
            ];
        }else{
            FavoritePost::create([
                "post_id" => $post->id,
                "user_id" => $request->user()->id
            ]);
            $post->favorite_count = $post->favorite_count + 1;
            $post->save();
            return [
                "success" => true
            ];
        }
    }

    public function favoriteCheck(Request $request, Posts $post){
        $isFavorite = FavoritePost::where('post_id',$post->id)->where('user_id', $request->user()->id)->exists();
        if($isFavorite){
            return [
                "success" => true
            ];
        }
        return [
            "success" => false
        ];
    }

    public function bookmarkCheck(Request $request, Posts $post){
        $isBookmarked = PostBookmark::where('post_id', $post->id)
            ->where('user_id', $request->user()->id);
        if($isBookmarked->exists()){
            return [
                "success" => true
            ];
        }

        return [
            "success" => false
        ];
    }

    public function bookmarkToggle(Request $request, Posts $post){
        $isFavorite = PostBookmark::where('post_id',$post->id)->where('user_id', $request->user()->id)->exists();
        if($isFavorite){
            PostBookmark::where('post_id',$post->id)->where('user_id', $request->user()->id)->delete();
            $post->bookmark_count = $post->bookmark_count - 1;
            $post->save();
            return [
                "success" => false
            ];
        }else{
            PostBookmark::create([
                "post_id" => $post->id,
                "user_id" => $request->user()->id
            ]);
            $post->bookmark_count = $post->bookmark_count + 1;
            $post->save();
            return [
                "success" => true
            ];
        }
    }
}
