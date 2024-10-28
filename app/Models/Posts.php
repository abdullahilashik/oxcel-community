<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Posts extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'user_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_category_rels', 'post_id', 'post_category_id');
    }


    public function scopeGetPostsPaginated($query, $perPage){
        $query->join('post_category_rels','post_category_rels.post_id','=','posts.id')
            ->join('post_categories','post_categories.id','=','post_category_rels.post_category_id')
            ->join('users','users.id','posts.user_id')
            ->with('categories')
            ->groupBy(['posts.id']);

            if(Auth::user()){
                // logged in
                $query
                ->leftJoin('post_bookmarks','post_bookmarks.user_id','=','users.id')
                ->leftJoin('favorite_posts','favorite_posts.user_id','=','users.id')
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

        return $query->paginate($perPage);
    }

    public function scopeGetPostBySlug($query, $slug){
        $query->join('post_category_rels','post_category_rels.post_id','=','posts.id')
            ->join('post_categories','post_categories.id','=','post_category_rels.post_category_id')
            ->join('users','users.id','posts.user_id')
            ->with('categories');

        if(Auth::user()){
            // logged in
            $query
            ->leftJoin('post_bookmarks','post_bookmarks.user_id','=','users.id')
            ->leftJoin('favorite_posts','favorite_posts.user_id','=','users.id')
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
