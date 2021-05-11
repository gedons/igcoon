<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;


class ProfilesController extends Controller
{
    public function index($ids)
    {
    	$user = User::findOrFail($ids);

    	return view('profiles.index', compact("user"));
    }
}
