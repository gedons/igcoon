<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\UserCreatePost;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Session;
use Image;
use Notification;
    
class PostsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {      
        //get all the users we are following
        $user = auth()->user()->following->pluck('user_id');

        //get the posts of all the user we are following
        $posts  = Post::whereIn('user_id', $user)->with('user')->latest()->get();

      
        
       
        return view('posts.index', compact('posts'));
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
					'caption' => 'required|max:100',	
                    'description' => 'max:1000',    
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
                'description' => $data['description'],
    			'image' => $imagepath,
    		]);

           // Notification::send(auth()->user(), new UserCreatePost($data['title']));
    		return Redirect('/profile/'.auth()->user()->id)->with('message', 'Post Created Successfully!!!');
    	
    }

    public function show($id)
    {
    
        $post = Post::findorFail($id);
        $comment = Comment::get();
        

         //get likes
        $liker = (auth()->user()) ? auth()->user()->liked->contains(auth()->user()->id) : false;
    
        return view("posts.show",compact("post","liker","comment"));
    }

    public function edit($id)
    {
        $post = Post::findorFail($id);
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, $id)
    {
            $data = $request->all();
            $post = Post::find($id);

            //validation     
        $data = $request->validate([                    
                    'caption' => 'required|max:100', 
                    'description' => 'max:1000',
                    'image' => '',          
                ]);

         //upload image
            if ($request->hasFile('image')) {

                    //imagepath
                    $imagepath = $request['image']->store('uploads', 'public');

                    //resize image
                    $image = Image::make(public_path("storage/{$imagepath}"))->fit(1000, 1000);
                    $image->save();

                     $post->image = $imagepath;
            } 

            $post->caption = $data['caption'];
            $post->description = $data['description'];
            $post->save();



        //Notification::send(auth()->user(), new UserCreatePost($data['caption']));
        return Redirect()->back()->with("message", "Post Updated Successfully!!!");
    }
    public function delete($id)
    {
        $post = Post::where('id',$id)->first();
        $path = "public/";
        
        //delete image from folder if exist
        if (file_exists($path.$post->image)) {
            unlink($path.$post->image);
        }

        $post->delete();

        return Redirect()->back()->with("message", "Post Deleted Successfully!!!");
    }
}
