@extends('user.layouts.navbariflogin')

@section('mainsection')

@if ($errors->any())
@foreach ($errors->all() as $error)
<div>{{$error}}</div>
@endforeach
@endif


<div class="container mt-3">
    <form method="POST" enctype="multipart/form-data" action="{{route('user.upload.videos')}}">
        @csrf

<div class="row">
    <div class="col">
    <div class="mt-2">
            <label for="exampleFormControlInput1" class="form-label"><b> Privcay: </b></label>
            <select name="privacy">
                <option value="" disabled selected>Public</option>
                <option value="public">Public</option>
                <option value="friends"> Friends </option>
                <option value="me"> Only Me </option>
            </select>
        </div>

    </div>

    <div class="col">
    <div class="mt-2">
            <label for="exampleFormControlInput1" class="form-label"><b> Select Album: </b></label>
            <select name="album_id">
            <option value="" disabled selected>Select Album </option>
                @foreach($album_detils as $album)
                <option value="{{$album->id}}">{{$album->album_name}}</option>
                @endforeach
            </select>
        </div>

    </div>



</div>
        

       

        <div class="mt-3">
            <label for="exampleFormControlInput1" class="form-label">Caption</label>
            <input type="text" class="form-control" name="caption" placeholder="This is Good.." autocomplete="off">
        </div>
        <div class="mt-3">
            <label for="formFileMultiple" class="form-label"><i class="bi bi-file-earmark-arrow-up-fill"></i> Add Videos </label> 
            <input class="form-control"   name="video" type="file" multiple class="form-control" >
            <div id="galeria" style=" display: flex; justify-content: space-evenly;   margin-top: 15px;">
        </div>

        <div class="mt-2">
            <button type="submit" class="btn btn-primary mb-3"> <i class="bi bi-file-earmark-arrow-up-fill"></i>Post</button>
        </div>
    </form>
</div>






@endsection