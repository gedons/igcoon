@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-8">
      <img src="/storage/{{$post->image}}" alt="" class="w-100">
    </div>
    <div class="col-4">
      <div>
        <div class="d-flex align-items-center">
          <div class="pr-3">
            @if ($post->user->profiles->image)
            <img src="/storage/{{$post->user->profiles->image}}" class="rounded-circle w-60" style="max-width: 40px;">
            @else
            <img src="{{ asset('images/img.png')}}" width="100px" class="rounded-circle">
            @endif
          </div>
          <div>
            <div class="font-weight-bold">
              <a href="/profile/{{$post->user->id}}">
                <span class="text-dark">{{$post->user->username}}</span>
            </a>       
          </div>
          <div>
            <like-button user-id="{{$post->id}}" liker="{{$liker}}"></like-button>
          </div>
        </div>
      </div>
      <hr>
      <p>
        <span class="font-weight-bold">
          <a href="/profile/{{$post->user->id}}">
            <span class="text-dark pr-1">{{$post->user->username}}</span>
          </a>
        </span>{{$post->caption}}
      </p>
      <p>{{$post->description}}</p>
    </div>

     <form action="{{ route('comment.create', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
       <div class="row">
             <x-alert/>
                    <input id="comment" type="text" name="comment" class="form-control @error('comment') is-invalid @enderror" autocomplete="comment" autofocus>

                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               <button class="btn btn-primary mt-2">Comment</button>
         </div>
   </form>
   <div>
     <p>{{auth()->user()->username}} : {{$post->comments->email}}</p>
   </div>
   </div>
</div>
</div>
@endsection