<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Notification;

class ProfileController extends Controller
{

    public function userprofile()
    {
        $userprofiles = User::get();

        return view('admin.userprofiles.userprofile', compact("userprofiles"));

    }

    public function viewUserprofile($id)
    {
        $user = User::findOrfail($id);
        $postCount = $user->posts->count();
        $followersCount = $user->profiles->followers->count();
        $followingCount = $user->following->count();

        return view('admin.userprofiles.viewUserprofile', compact('user','postCount','followersCount','followingCount'));
    }
    public function updateProfilestatus(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = $request->all();

             if ($data['status']=="Active") {
                $status = 0;
             }else{
                $status = 1;
             }
              Profile::where('id',$data['profile_id'])->update(['status'=>$status]);
              return response()->json(['status'=>$status,'profile_id'=>$data['profile_id']]);
        }
    }

    public function verifyProfilestatus(Request $request)
    {
        

        if ($request->ajax()) 
        {
            $data = $request->all();

             if ($data['status']=="Active") {
                $status = 0;
             }else{
                $status = 1;
             }
              Profile::where('id',$data['verify_id'])->update(['verifybadge'=>$status]);
              return response()->json(['status'=>$status,'verify_id'=>$data['verify_id']]);
        }
        
    }
}
