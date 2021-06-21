<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($id)
    {
        $post = Post::findorFail($id);
        return auth()->user()->liked()->toggle($post->id);
        
    }
}
