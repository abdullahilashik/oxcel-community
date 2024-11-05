<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class Posts extends Model
{
    use Searchable, Notifiable;


    protected $fillable = [
        'title',
        'slug',
        'description',
        'user_id'
    ];

    // Define the data you want to index
    // public function toSearchableArray()
    // {
    //     return [
    //         'id' => $this->id,
    //         'title' => $this->title,
    //         'description' => $this->description,
    //     ];
    // }

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_category_rels', 'post_id', 'post_category_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function toSearchableArray()
        {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'created_at'=> $this->created_at,
                'user' => [
                    'id' => $this->user->id,
                    'fname' => $this->user->fname,
                    'lname' => $this->user->lname
                ],
                'categories' => $this->categories->pluck('slug')->toArray(), // Array of category names
            ];
    }

    public function toArray()
        {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'created_at'=> $this->created_at,
                'user' => [
                    'id' => $this->user->id,
                    'fname' => $this->user->fname,
                    'lname' => $this->user->lname
                ],
                'categories' => $this->categories->pluck('slug')->toArray()
            ];
    }

    protected function makeAllSearchableUsing($query){
        return $query
                        ->with('user')
                        ->with('categories');
    }


    // search posts with keyword and category; sort them later
    public function scopeSearchPost($query, $keyword, $category, $sort, $paginate=false)
    {
        $query->join('post_category_rels', 'post_category_rels.post_id', '=', 'posts.id')
            ->join('post_categories', 'post_categories.id', '=', 'post_category_rels.post_category_id')
            ->join('users', 'users.id', 'posts.user_id')
            ->with('categories')
            ->with('user')
            ->groupBy(['posts.id']);

        if ($keyword) {
            $query->where('posts.title', 'like', '%' . $keyword . '%');
        }

        if($category){
            $query->where('post_categories.slug',$category);
        }

        if($sort){
            switch($sort){
                case 'newest':
                    $query->orderBy('posts.created_at','desc');
                    break;
                case 'oldest':
                    $query->orderBy('posts.created_at','asc');
                    break;
                case 'ascending':
                    $query->orderBy('posts.title','asc');
                    break;
                case 'descending':
                    $query->orderBy('posts.title','desc');
                    break;
                case 'trending':
                    $query->orderBy('posts.view_count','desc');
                    break;
                case 'favorite':
                    $query->orderBy('posts.favorite_count','desc');
                    break;
                default:
                    break;
            }
        }

        if (Auth::user()) {
            // logged in
            $query
                ->leftJoin('post_bookmarks', 'post_bookmarks.user_id', '=', 'users.id')
                ->leftJoin('favorite_posts', 'favorite_posts.user_id', '=', 'users.id')
                ->select([
                    'posts.*',
                    'users.fname',
                    'users.id as uid',
                    'users.lname',
                    // 'post_bookmarks.user_id',
                    'favorite_posts.id as favorite_by_user'
                ]);
        } else {
            $query->select([
                'posts.*',
                'users.fname',
                'users.lname',
                'users.id as uid'
            ]);
        }

        if($paginate){
            return $query->paginate($paginate);
        }else{
            return $query->get();
        }
    }

    public function scopeGetPostsPaginated($query, $perPage)
    {
        $query->join('post_category_rels', 'post_category_rels.post_id', '=', 'posts.id')
            ->join('post_categories', 'post_categories.id', '=', 'post_category_rels.post_category_id')
            ->join('users', 'users.id', 'posts.user_id')
            ->with('categories')
            ->with('user')
            ->groupBy(['posts.id']);

        if (Auth::user()) {
            // logged in
            $query
                ->leftJoin('post_bookmarks', 'post_bookmarks.user_id', '=', 'users.id')
                ->leftJoin('favorite_posts', 'favorite_posts.user_id', '=', 'users.id')
                ->select([
                    'posts.*',
                    'users.fname',
                    'users.id as uid',
                    'users.lname',
                    'favorite_posts.user_id as favorite_by_user'
                    // 'favorite_posts.id as favorite_by_user'
                ]);
        } else {
            $query->select([
                'posts.*',
                'users.fname',
                'users.lname',
                'users.id as uid'
            ]);
        }

        return $query->paginate($perPage);
    }

    public function scopeGetPostBySlug($query, $slug)
    {
        $query->join('post_category_rels', 'post_category_rels.post_id', '=', 'posts.id')
            ->join('post_categories', 'post_categories.id', '=', 'post_category_rels.post_category_id')
            ->join('users', 'users.id', 'posts.user_id')
            ->with('categories')
            ->with('user');

        if (Auth::user()) {
            // logged in
            $query
                ->leftJoin('post_bookmarks', 'post_bookmarks.user_id', '=', 'users.id')
                ->leftJoin('favorite_posts', 'favorite_posts.user_id', '=', 'users.id')
                ->select([
                    'posts.*',
                    'users.fname',
                    'users.lname',
                    'users.id as uid',
                    // 'post_bookmarks.user_id',
                    'favorite_posts.id as favorite_by_user'
                ]);
        } else {
            $query->select([
                'posts.*',
                'users.fname',
                'users.lname',
                'users.id as uid'
            ]);
        }

        return $query->where('posts.slug', $slug)->first();
    }
}
