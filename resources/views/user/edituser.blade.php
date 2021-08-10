@extends('user.layouts.navbariflogin')

@section('mainsection')

<div class="container mt-3">
    <form method="POST" action="{{route('user.profileeditaction')}}">
    @csrf
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1" class="form-label">User Name:</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}">
            </div>
            <div class="col">
                <label class="form-label">Phone No:</label>
                <input name="phone" class="form-control" type="tel" value="{{$user->phone}}">
            </div>
        </div>

        <div class="mt-2">
            <label class="form-label">Bio:</label>
            <input class="form-control" name="bio" rows="3" value="{{$user->bio}}"></input>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary mb-3"><i class="bi bi-file-earmark-arrow-up-fill"></i>Update</button>
        </div>
    </form>
</div>





@endsection