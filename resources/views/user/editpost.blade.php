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

@foreach($post_details as $post)

<div class="d-flex justify-content-center mt-3">
    <div class="card" style="width: 18rem;">
    <p style="margin-left:250px ;  margin-top:3px;"><a href="{{route('user.deletepost', $post->id)}}"> <i class="bi bi-trash-fill"></i></a></p>

        <img src="{{asset($post->image_path)}}" class="card-img-top" alt="Post">

        <span style="color: gray; margin-left:auto" class="created_at" timestamp="{{ Carbon\Carbon::parse($post->created_at)->timestamp }}"></span>
        <div class="card-body">

            <form method="POST" action="{{route('user.editpostaction', $post->id)}}">
                @csrf

                <div class="mt-2">
                    <label for="exampleFormControlInput1" class="form-label"><b> Privcay: </b></label>
                    <select name="privacy">
                        <option value="" disabled selected>{{ $post->postDetailsToPost->privacy }}</option>
                        <option value="public">Public</option>
                        <option value="friends"> Friends </option>
                        <option value="me"> Only Me </option>
                    </select>
                </div>


                <div class="col">
                    <label class="form-label">Caption</label>
                    <input name="caption" class="form-control" value="{{ $post->caption }}">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary mb-3">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready(() => {
        $(".created_at").each(function(index) {
            let timestamp = $(this).attr('timestamp');
            $(this).html(moment.unix(timestamp).format('DD MMM YYYY,hh:mm A'));
        });
    });
</script>



@endsection