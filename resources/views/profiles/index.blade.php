@extends('layouts.app')

@section('content')
<div class="container">
    @if($user->profiles->status == 1)
    <div class="row">
        <div class="col-3 p-5">
             @if ($user->profiles->image)
            <img src="/storage/{{$user->profiles->image}}" width="100px" class="rounded-circle">
             @else
             <img src="{{ asset('images/img.png')}}" width="100px" class="rounded-circle">
             @endif
        </div>
        
        <div class="col-9 pt-5">
            <x-alert/>
            <div class="d-flex justify-content-between align-items-baseline">

                <div class="d-flex align-items-center pb-3">
                    <div class="h4">
                         @if($user->profiles->verifybadge == 1)
                            {{$user->username }} <p>verified</p>
                         @else
                            {{$user->username }} <p>unverified</p>
                         @endif
                        <!--  {{$user->username }} -->
                    </div>  
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
            <div><a href="{{$user->profiles->url}}">{{$user->profiles->url}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4"> 

            <a href="{{route('post.show',$post->id)}}">
               <img src="/storage/{{$post->image}}" class="w-100"> 
            </a> 
             <div class="d-flex pt-1">
                    <a href="{{ route('post.edit',$post->id) }}" class="btn btn-primary">Edit</a>
                     <form action="{{ route('post.delete', $post->id) }}" method="post">
                        @csrf
                        <div class="pl-2"><button type="submit" class="btn btn-light">Delete</button></div>
                    </form>
             </div>
        </div>
       @endforeach
    </div>
    @else
    <p>Account Deactivated</p>
    @endif
</div>
@endsection
