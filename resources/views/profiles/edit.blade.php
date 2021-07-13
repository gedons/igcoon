@extends('layouts.app')

@section('content')
<div class="container">
    @if($user->profiles->status == 1)
    <form action="{{route('profile.update',$user->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
       <div class="row">
       <div class="col-8 offset-2">

             <div class="row">
                 <h1>Edit Profile</h1>
             </div>
             <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label">Title</label>

                    <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" autocomplete="title" value="{{old('title') ?? $user->profiles->title}}" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

              <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label">Description</label>

                    <input id="description" type="text" name="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description" value="{{old('description') ?? $user->profiles->description}}" autofocus>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

             <div class="form-group row">
                <label for="url" class="col-md-4 col-form-label">URL</label>

                    <input id="url" type="text" name="url" class="form-control @error('url') is-invalid @enderror" autocomplete="url" value="{{old('url') ?? $user->profiles->url}}" autofocus>

                    @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="row">
               <label for="image" class="col-md-4 col-form-label">Profile Image</label>
               <input type="file" name="image" id="image" class="form-control-file">
                 @error('image')
                        <strong>{{ $message }}</strong>
                @enderror
           </div>

           <div class="row pt-4">
               <button class="btn btn-primary">Save Profile</button>
           </div>

       </div>
   </div>
     @else
    <p>Account Deactivated</p>
    @endif
</div>
@endsection
