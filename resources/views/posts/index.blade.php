@extends('layouts.app')
@section('content')
<div class="container">

      <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome</div>
                <div class="d-flex">
                <div class="card-body">
                   Follow An Account To See New Posts!!!
                </div>
                <div class="pt-3 pr-2">
                  <a href="/profile/2" class="btn btn-light">Follow</a>
                </div>
              </div>
            </div>
        </div>
    </div>
    <hr>

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
            
             @if ($post->comments->count() > 1)
              <p>{{$post->comments->count()}} Comments</p>
            @else
              <p>{{$post->comments->count()}} Comment</p>
            @endif
          </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection