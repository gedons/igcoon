@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="/images/img.jpg" width="100px" class="rounded-circle">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{$user->username }}</h1>   
                <a href="{{route('post.create')}}" style="float: right;" class="btn btn-primary">Add New Post</a>             
            </div>
                <div class="d-flex">
                <div class="pr-5"><strong>{{$user->posts->count()}}</strong> posts</div>
                <div class="pr-5"><strong>300k</strong> followers</div>
                <div class="pr-5"><strong>40k</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profiles->title}}</div>
            <div>{{$user->profiles->description}}</div>
            <div><a href="#">{{$user->profiles->url}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4"> 
                <img src="/storage/{{$post->image}}" class="w-100">
        </div>
       @endforeach
    </div>  
</div>
@endsection
