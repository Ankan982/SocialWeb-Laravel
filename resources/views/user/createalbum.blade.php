@extends('user.layouts.navbariflogin')

@section('mainsection')

@if ($errors->any())
@foreach ($errors->all() as $error)
<div>{{$error}}</div>
@endforeach
@endif

<h2 class="text-center">Create Album</h2>
<div class="container mt-3">
    <form method="POST" enctype="multipart/form-data" action="{{route('user.upload')}}">
        @csrf


        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Album Name</label>
            <input type="text" class="form-control" name="album_name" placeholder="India Tour.." autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label"><i class="bi bi-file-earmark-arrow-up-fill"></i> Add cover image </label> 
            <input class="form-control" onchange="previewMultiple(event)" id="imagepreview"  name="images[]" type="file" multiple class="form-control" accept="image/*">
            <div id="galeria" style=" display: flex; justify-content: space-evenly;   margin-top: 15px;">
        </div>

        <div class="mb-5">
            <button type="submit" class="btn btn-primary mb-3"> <i class="bi bi-file-earmark-arrow-up-fill"></i>Create</button>
        </div>
    </form>
</div>

<script>
function previewMultiple(event){
        var images = document.getElementById("imagepreview");
        var image_len = images.files.length;
      //  console.log(image_len)

        for( var i = 0; i < image_len; i++){
            var urls = URL.createObjectURL(event.target.files[i]);
            document.getElementById("galeria").innerHTML += '<img style="display: flex; height: 85px; width:85px; border-radius: 10px;  box-shadow: 0 0 8px rgba(0,0,0,0.2);" src="'+urls+'">';
        }
    }

</script>




@endsection