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

<div class="app">

     <header>
          <h4>📣 Group Chat 📣</h4>
     </header>


     <div id="messages">
          @if(!$all_message->isEmpty() )
          @foreach($all_message as $msg)

          <div class="message"><strong> {{$msg->userName->name}} :</strong> {{$msg->message}}</div>

          @endforeach
     </div>

     @else


     <p class="text-center text-primary mt-5">You can start the conversation.<br>
      Let's Chat ❗❗ <br></p>


</div>


@endif

<form id="message_form">

     <p readonly type="text" name="username" id="username" disabled value="{{ $username }}"></p>

     <input type="text" name="message" id="message_input" placeholder="Write a message..." autocomplete="off" />
     <button type="submit" id="message_send"><i class="bi bi-cursor-fill"></i></button>
</form>
</div>



<script src="{{ asset('js/app.js') }}"></script>
@endsection