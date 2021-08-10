@extends('user.layouts.navbariflogin')

@section('mainsection')


@if(Session::has('message-success'))
<div class="alert alert-success mt-5" role="alert">
  {{Session::get('message-success')}}
</div>
@endif


@if(Session::has('message-error'))
<div class="alert alert-danger mt-5" role="alert">
  {{Session::get('message-error')}}
</div>
@endif

<div class="container mt-3">
  <div class="row ">
   <!-- <div class="col-md-6 img">
      <img src="https://st3.depositphotos.com/5392356/i/600/depositphotos_137026300-stock-photo-programmer-working-in-a-software.jpg"  width="350" height="220">
    </div>-->
    <div class="col-md-12 details">
      <blockquote>
        <h5>{{$user->name}}</h5>
        <small>Email:<cite title="Source Title"> <b>{{$user->email}}</b> <i class="icon-map-marker"></i></cite></small>
      </blockquote>
      Phone: <b>{{$user->phone}}</b>
      <p>
        Bio: {{$user->bio}}
      </p>
      <a class="btn btn-primary mt-2" href="{{route('user.profileedit')}}"><i class="bi bi-pencil-fill"></i>Add Bio & Edit Profile</a>
    </div>
  </div>
</div>

<h1 class="text-center">All Your Posts</h1>

@if(!$user_posts->isEmpty() ) 
  @foreach($user_posts as $posts)
  <div class="row mt-5">
    @foreach($posts->allPosts as $post)

 
      <div class="col d-flex justify-content-center">
          <div class="card" style="width: 18rem;">
            
            <div class="d-flex justify-content-between">
            <p style="margin-left:9px ;  margin-top:3px;"><i class="bi bi-shield-fill"></i> {{$posts->privacy}}</p>
            <p style="margin-right:9px ; margin-top:3px"> <a href="{{route('user.editpost', $post->id)}}"> <i class="bi bi-list"></i> </a></p>
            </div>

              <img src="{{asset($post->image_path)}}" class="card-img-top" alt="Post">
              <div class="card-body">
                  <h5 class="card-title">{{ $post->caption }}</h5>
          <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                  <div class="d-flex justify-content-between">
                   <a href="{{ route('user.comments', $post->id)}}" class="btn btn-warning mt-2"><i class="bi bi-chat-right-text"> Comments</i></a>
                  </div>

              </div>
          </div> 
      </div>


  @endforeach
  </div>
  @endforeach  

@else  


<p class="text-center mt-5"> You have no posts yet. <b style="color: rgb(13,110,253);">Let's Create One!! </b></p>
<div class="d-flex justify-content-center">
<a href="{{route('user.post')}}" "><button type="button" class="btn btn-primary  mt-2 ">Post</button></a>
</div>

</div>


@endif

@endsection