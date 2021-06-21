@extends('layouts.app')
@section('content')
<div class="container">
  @foreach($posts as $post)
  <div class="row">
    <div class="col-6 offset-3">
      <a href="/post/{{$post->id}}"><img src="/storage/{{$post->image}}" alt="" class="w-100"></a>
    </div>
  </div>
  <div class="row pt-2 pb-4">
    <div class="col-6 offset-3">
      <div>
        <p>
          <span class="font-weight-bold">
            <a href="/profile/{{$post->user->id}}">
              <span class="text-dark pr-1">{{$post->user->username}}</span>
            </a>
          </span>{{$post->caption}}
        </p>
          <div>
            @if ($post->likes->count() > 1)
              <p>{{$post->likes->count()}} Likes</p>
            @else
              <p>{{$post->likes->count()}} Like</p>
            @endif
            
            <p>3 comments</p>
          </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection