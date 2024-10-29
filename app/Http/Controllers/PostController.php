<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\PostCategory;
use App\Models\PostCategoryRel;
use App\Models\PostComment;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(){
        $posts = Posts::getPostsPaginated(10);
        $totalMembers = User::count();
        $totalPosts = Posts::count();
        $categories = PostCategory::all();
        $postsCount = Posts::whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year)
                  ->count();

        return view('home')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('total_members', $totalMembers)
            ->with('total_posts', $totalPosts)
            ->with('posts_per_month', $postsCount);
    }

    public function search(Request $request){
        $category = $request->get('filter');
        $sort = $request->get('sort');
        $keyword = $request->get('query');
        $posts = Posts::search($keyword, $category, $sort ,10);
        $totalMembers = User::count();
        $totalPosts = Posts::count();
        $categories = PostCategory::all();
        $postsCount = Posts::whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year)
                  ->count();
        $posts->appends($request->query());

        return view('home')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('total_members', $totalMembers)
            ->with('total_posts', $totalPosts)
            ->with('posts_per_month', $postsCount);
    }

    public function create(){
        $categories = PostCategory::where('is_active',1)->get();
        return view('posts.create')
            ->with('categories', $categories);
    }

    public function store(PostCreateRequest $request){
        $data = $request->validated();
        $post = Posts::create([
            ...$data,
            'slug'=> Str::slug($data['title'],'-'),
            'user_id' => Auth::user()->id,
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
        return back()
                ->with('success', 'Post Created successfully!')
                ->with('post',$post);
    }

    public function show($slug){
        $post = Posts::GetPostBySlug($slug);

        $post->view_count = $post->view_count + 1;
        $post->save();

        $categories = PostCategory::all();


        $comments = PostComment::getCommentsByPostId($post->id);
        $comments->appends(request()->query());
        return view('posts.show')
            ->with('post', $post)
            ->with('categories', $categories)
            ->with('comments',$comments);
    }
}
