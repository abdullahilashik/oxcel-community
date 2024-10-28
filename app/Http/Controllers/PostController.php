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

class PostController extends Controller
{
    public function index(){
        $posts = Posts::getPostsPaginated(10);
        // dd($posts, Auth::user());
        $totalMembers = User::count();
        $totalPosts = Posts::count();
        return view('home')
            ->with('posts', $posts)
            ->with('total_members', $totalMembers)
            ->with('total_posts', $totalPosts);
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
        // dd($post);
        $comments = PostComment::getCommentsByPostId($post->id);
        return view('posts.show')
            ->with('post', $post)
            ->with('comments',$comments);
    }
}
