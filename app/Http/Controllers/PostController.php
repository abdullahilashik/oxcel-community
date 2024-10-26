<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('home');
    }

    public function create(){
        return view('posts.create');
    }

    public function store(PostCreateRequest $request){
        dd($request->all());
    }

    public function show($slug){
        return view('posts.show');
    }
}
