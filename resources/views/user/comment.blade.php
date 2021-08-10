@extends('user.layouts.navbariflogin')

@section('mainsection')

@if(Session::has('message-success'))
<div class="alert alert-success mt-5" role="alert">
    {{Session::get('message-success')}}
</div>
@endif

@if(Session::has('message-error'))
<div class="alert alert-error mt-5" role="alert">
    {{Session::get('message-error')}}
</div>
@endif

<div class="row">

    <div class="col">

        @foreach($posts as $post)
        <div class="d-flex justify-content-center mt-3">
            <div class="card" style="width: 18rem;">

                <img src="{{asset ($post->image_path)}}" class="card-img-top" alt="Post">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->caption }}</h5>
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="col">
        <div class="d-flex mt-2 bg-light text-white">
            
            @if(!$comments->isEmpty() )
            
            <figure class="text-center">
            @foreach($comments as $comment)
                <blockquote class="blockquote">
                    <p class="text-dark">{{ $comment->comment }}</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    {{$comment->commentToUser->name}}
                </figcaption>
                @endforeach
            </figure>
           

            @else
            <p class="text-center ml-5 text-dark mt-5"> This post has no comment. <i class="bi bi-emoji-frown-fill"></i></p>
            @endif
        </div>
    </div>


    <div class="col">
        <div class="d-flex">
            <form method="POST" action="{{ route('user.commentUpload' , $post->id ) }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Your Comment</label>
                    <textarea type="text" name="comments" class="form-control" placeholder="Enter Your comment..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
            </form>
        </div>
    </div>

</div>


@endsection