@extends('user.layouts.navbariflogin')

@section('mainsection')


<h4>Friend List</h4>

@foreach($friend_list as $friend)

<div class="d-flex ml-3">
<p> {{$friend->name}}</p>
</div>


@endforeach


@endsection