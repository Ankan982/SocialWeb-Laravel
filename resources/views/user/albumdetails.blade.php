@extends('user.layouts.navbariflogin')

@section('mainsection')

@if ($errors->any())
@foreach ($errors->all() as $error)
<div>{{$error}}</div>
@endforeach
@endif

<h1 class="text-center mt-3">Album Details</h1>

@foreach($album_info as $album)
<div class="card bg-dark text-white" style="width: 60%; height:30% ;  margin: auto;">
  <img src="{{asset($album->cover_image)}}" class="card-img" alt="lbum cover">
  <div class="card-img-overlay">
    <h5 class="card-title">{{$album->album_name}}</h5>
   <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
   <p><span class="created_at" timestamp="{{ Carbon\Carbon::parse($album->created_at)->timestamp }}"></span></p>
  </div>
</div>
@endforeach

@if(!$album_details->isEmpty() ) 

@foreach($album_details as $album)
@foreach($album->allPosts as $posts)

<div class="d-flex justify-content-center mt-3">
    <div class="card" style="width: 18rem;">

        <div class="d-flex justify-content-between">
            <p style="margin-right:9px ;  margin-top:3px;"><i class="bi bi-shield-fill"></i> {{$album->privacy}}</p>
        </div>

        <img src="{{asset($posts->image_path)}}"  class="card-img-top" alt="Post">
        <div class="card-body">
            <h5 class="card-title">{{ $posts->caption }}</h5>
            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
            <div class="d-flex justify-content-between">
                <i class="bi bi-star"></i>
                <i class="bi bi-chat-right-text"></i>
                <i class="bi bi-bookmark"></i>
            </div>

        </div>
    </div>
</div>

@endforeach
@endforeach



@else  


<p class="text-center mt-5"> You have no images here yet. Let's add !!!</p>
<div class="d-flex justify-content-center">
<a href="{{route('user.post')}}" "><button type="button" class="btn btn-primary  mt-2 ">Post</button></a>
</div>

<script>
    
  $(document).ready(() => {
    $(".created_at").each(function(index) {
      let timestamp = $(this).attr('timestamp');
      $(this).html(moment.unix(timestamp).format('DD MMM YYYY,hh:mm A'));
    });
  });

</script>
</div>




@endif

@endsection