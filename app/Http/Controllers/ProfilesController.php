<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Image;


class ProfilesController extends Controller
{

    public function index($id)
    {
    	$user = User::findOrFail($id);

    	return view('profiles.index', compact("user"));
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


    	return Redirect("/profile/{$user->id}")->with("message", "Profile Updated Successfully!!!");
				
    }
}
