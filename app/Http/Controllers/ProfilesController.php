<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Notifications\UserCreatePost;
use Notification;
use Image;
use Cache;


class ProfilesController extends Controller
{

    public function index($id)
    {
    	$user = User::findOrFail($id);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        //use cache
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
             now()->addSeconds(30),
              function () use ($user) {
                 return $user->posts->count();
            });


        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
             now()->addSeconds(30),
              function () use ($user) {
                 return $user->profiles->followers->count();
            });



        $followingCount = Cache::remember(
            'count.following.' . $user->id,
             now()->addSeconds(30),
              function () use ($user) {
                 return  $user->following->count();
            });


    	return view('profiles.index', compact("user","follows", "postCount", "followersCount", "followingCount"));
    }

    public function edit($id)
    {

    	$user = User::findOrFail($id);

    	//authorize authenticated user from the (profilePolicy)
    	$this->authorize('update',$user->profiles);

    	return view('profiles.edit', compact("user"));
    }

    public function update(Request $request, $id)
    {
    	$user = User::findOrFail($id);

    	//authorize authenticated user from the (profilePolicy)
    	$this->authorize('update',$user->profiles);

    	//validation	 
    	$data = $request->validate([					
					'title' => 'required|regex:/^[\pL\s\-]+$/u|max:100',	
					'description' => 'required|max:100',	
					'url' => 'required|url|max:100',	
					'image' => '',			
				]);

    	 //upload image
	        if (request('image')) {

			        //imagepath
		    		$imagepath = $request['image']->store('profile', 'public');

		            //resize image
		            $image = Image::make(public_path("storage/{$imagepath}"))->fit(1000, 1000);
		            $image->save();

		            $imageArray = ['image' => $imagepath];
	        } 

	        auth()->user()->profiles->update(array_merge(
	        	$data,
	        	$imageArray ?? []
	        	
	        ));

       // Notification::send(auth()->user(), new UserCreatePost($data['title']));
    	return Redirect("/profile/{$user->id}")->with("message", "Profile Updated Successfully!!!");
				
    }
}
