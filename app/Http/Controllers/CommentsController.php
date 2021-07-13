<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentsController extends Controller
{
    public function create(Request $request, $id)
    {
        $data = $request->all();
                $rules = [                  
                    'comment' => 'required|max:500',                   
                ];            
            $this->validate($request,$rules);

        $post = Post::findOrfail($id);

        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->name = $data['name'];
        $comment->post()->associate($post);

        $comment->save();
      
        return Redirect()->back()->with('message', 'Comment Added Successfully');

    }
}
