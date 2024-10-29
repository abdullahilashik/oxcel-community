<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        $categories = PostCategory::all();
        return view('account.index')
            ->with('categories',$categories);
    }
}
