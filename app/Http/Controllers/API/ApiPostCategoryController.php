<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class ApiPostCategoryController extends Controller
{
    public function categoryList(){
        $categories = PostCategory::all();
        return $categories;
    }
}
