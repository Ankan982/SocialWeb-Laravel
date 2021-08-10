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


@if(!$all_posts->isEmpty() )

@foreach($all_posts as $posts)

@foreach($posts->allPosts as $post)


<div class="d-flex justify-content-center mt-2">
    <div class="card" style="width: 18rem;">

        <div class="d-flex justify-content-between bg-dark">
            <p style="margin-left:9px ; margin-top:5px;" class= "text-white"><i class="bi bi-person-circle"></i> <b>{{$posts->postToUser->name}} </b> </p>
            <p style="margin-right:9px ;  margin-top:5px;" class= "text-secondary"><i class="bi bi-shield-fill"></i> {{$posts->privacy}}</p>
        </div>

        <img src="{{asset($post->image_path)}}" class="card-img-top" alt="Post">
        <div class="card-body bg-dark text-white">
            <h5 class="card-title">{{ $post->caption }}</h5>
            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
            <div class="d-flex justify-content-between">
                <p>Like: {{count($posts->likes)}}</p>
                  
                <a href="{{route('user.likepost', $post->id )}}"><i class="bi bi-hand-thumbs-up-fill"></i></a>
               <a href="{{route('user.comments', $post->id )}}"><i class="bi bi-chat-fill"></i></a>

            </div>

        </div>
    </div>
</div>


@endforeach
@endforeach

@else


<p class="text-center mt-5"> You have no Posts yet. Let's create One!!</p>
<div class="d-flex justify-content-center">
    <a href="{{route('user.post')}}" "><button type=" button" class="btn btn-primary  mt-2 ">Post</button></a>
</div>

</div>


@endif


@endsection