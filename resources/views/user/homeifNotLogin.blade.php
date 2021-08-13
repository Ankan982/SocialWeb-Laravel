@extends('user.layouts.navbarifNotlogin')

@section('mainsection')

@foreach($all_posts as $posts)
@foreach($posts->allPosts as $post)

<div class="d-flex justify-content-center mt-3">
    <div class="card" style="width: 18rem;">


        <div class="d-flex justify-content-between">
            <p style="margin-left:9px ; margin-top:3px"><i class="bi bi-person-circle"></i> <b>{{$posts->postToUser->name}} </b> </p>

        </div>

        <img src="{{asset($post->image_path)}}" class="card-img-top" alt="Post">
        <div class="card-body">
            <h5 class="card-title">{{ $post->caption }}</h5>
            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
            <div class="d-flex justify-content-between">
            <a href="{{route('user.signin' )}}"><i class="bi bi-hand-thumbs-up-fill"></i></a>
               <a href="{{route('user.signin')}}"><i class="bi bi-chat-fill"></i></a>
            </div>

        </div>
    </div>
</div>


@endforeach
@endforeach



@endsection