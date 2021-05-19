<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Session;
use Image;

class PostsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function create()
    {
    	return view('posts.create');
    }
    public function store(Request $request)
    {

    	// $post = new Post;
    	$data = $request->all();

    		//  validation
				$rules = [					
					'caption' => 'required|regex:/^[\pL\s\-]+$/u|max:100',	
					'image' => 'required|image',				
				];
				
    		$this->validate($request,$rules);

    	   //imagepath
    		$imagepath = $data['image']->store('uploads', 'public');

            //resize image
            $image = Image::make(public_path("storage/{$imagepath}"))->fit(1200, 1200);
            $image->save();
    		
    		
    		auth()->user()->posts()->create([
    			'caption' => $data['caption'],
    			'image' => $imagepath,
    		]);

    		return Redirect('/profile/'.auth()->user()->id)->with('message', 'Caption Created Successfully!!!');
    	
    }

    public function show($id)
    {
        $post = Post::findorFail($id);
    
        return view("posts.show",compact("post"));
    }
}
