<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
            ->select([
                'posts.*',
                'users.fname',
                'users.lname'
            ])
            ->with('categories')
            ->groupBy(['posts.id']);

        return $query->paginate($perPage);
    }

    public function scopeGetPostBySlug($query, $slug){
        $query->join('post_category_rels','post_category_rels.post_id','=','posts.id')
            ->join('post_categories','post_categories.id','=','post_category_rels.post_category_id')
            ->join('users','users.id','posts.user_id')
            ->select([
                'posts.*',
                'users.fname',
                'users.lname'
            ])
            ->with('categories')
            ->where('posts.slug', $slug);

        return $query->first();
    }
}
