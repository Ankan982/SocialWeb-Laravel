@extends('user.layouts.navbariflogin')

@section('mainsection')

@if ($errors->any())
@foreach ($errors->all() as $error)
<div>{{$error}}</div>
@endforeach
@endif

<h2 class="text-center mt-3">Albums</h2>
<div class="d-flex justify-content-center">
<a href="{{route('user.cretealbum')}}" class="btn btn-primary mt-2"> Create Album <i class="bi bi-plus-circle-fill"></i></a>
</div>

@if(!$album_details->isEmpty() ) 
<div class="d-flex flex-row bd-highlight p-2">
@foreach($album_details as $album) 
<div class="d-flex justify-content-center p-2">

<div class="card" style="width: 18rem;">
  <img src="{{asset($album->cover_image)}}" class="card-img-top" alt="Album Cover">
  <div class="card-body">
    <h5 class="card-title">{{$album->album_name}}</h5>
    <a href="{{route('user.albumdetails',$album->id)}}" class="btn btn-primary"> More</a>
  </div>
</div>

</div>

@endforeach

@else  

<p class="text-center mt-5"> You have no albums yet. <b style="color: rgb(13,110,253);">Let's Create One!! </b></p>

</div>


@endif

</div>







@endsection