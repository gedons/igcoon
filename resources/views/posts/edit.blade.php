@extends('layouts.app')

@section('content')
<div class="container">
   <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
       <div class="row">
       <div class="col-8 offset-2">

             <div class="row">
                 <h1>Edit Post</h1>
             </div>
             <x-alert/>
             <div class="row">
                <label for="caption" class="col-md-4 col-form-label">Post Caption</label>

                    <input id="caption" type="text" name="caption" class="form-control @error('caption') is-invalid @enderror" autocomplete="caption" value="{{old('caption') ?? $post->caption}}" autofocus>

                    @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
             <div class="row">
                <label for="description" class="col-md-4 col-form-label">Post Description</label>

                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description" autofocus>{{old('description') ?? $post->description}}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="row pt-1">
                @if ($post->image)
                <img src="/storage/{{$post->image}}" width="100px" class="rounded-circle">
                @else
                <img src="{{ asset('images/img.png')}}" width="100px" class="rounded-circle">
                @endif
            </div>

            <div class="row">
               <label for="image" class="col-md-4 col-form-label">Post Image</label>
               <input type="file" name="image" id="image" class="form-control-file">
                 @error('image')
                        <strong>{{ $message }}</strong>
                @enderror
           </div>

           <div class="row pt-4">
               <button class="btn btn-primary">Update Post</button>
           </div>

       </div>
   </div>
   </form>
</div>
@endsection
