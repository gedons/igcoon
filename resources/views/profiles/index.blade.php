@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="/storage/{{$user->profiles->image}}" width="100px" class="rounded-circle">
        </div>
        
        <div class="col-9 pt-5">
            <x-alert/>
            <div class="d-flex justify-content-between align-items-baseline">

                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{$user->username }}</div>  
                    <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                </div>

                @can('update',$user->profiles) 
                    <a href="{{route('post.create')}}" style="float: right;" class="btn btn-light">Add New Post</a>
                @endcan
                 
            </div>
            @can('update',$user->profiles)
                <a href="{{route('profile.edit',$user->id)}}">Edit Profile</a>
            @endcan
                <div class="d-flex">
                <div class="pr-5"><strong>{{$postCount}}</strong> posts</div>
                <div class="pr-5"><strong>{{$followersCount}}</strong> followers</div>
                <div class="pr-5"><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profiles->title}}</div>
            <div>{{$user->profiles->description}}</div>
            <div><a href="#">{{$user->profiles->url}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4"> 

            <a href="{{route('post.show',$post->id)}}">
               <img src="/storage/{{$post->image}}" class="w-100"> 
            </a> 
        </div>
       @endforeach
    </div>  
</div>
@endsection
