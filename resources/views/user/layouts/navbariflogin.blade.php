<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SocialWeb-Home</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/user/image.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,600&display=swap" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>


<body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('user.home')}}">SocialWeb</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">

            <a class="nav-link @if(request()->route()->getName() =='user.home' ) active @endif " href="{{route('user.home')}}"> <i class="bi bi-house-door-fill"></i>{{ __('menu.Home') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(request()->route()->getName() =='user.post' ) active @endif" href="{{route('user.post')}}"><i class="bi bi-camera-fill"></i> {{__('menu.Add Post')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(request()->route()->getName() =='user.album' ) active @endif" href="{{route('user.album')}}"><i class="bi bi-collection-fill"></i> Albums</a>
          </li>


          <li class="nav-item">
            <a class="nav-link @if(request()->route()->getName() =='user.chats' ) active @endif" href="{{route('user.chats')}}"><i class="bi bi-chat-text"></i> Group Chat</a>
          </li>

        </ul>

        <div>
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-translate"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @php
            $locale = Session::get('locale') ?? 'en' ;
            @endphp
            <li><a class="dropdown-item @if($locale == 'en' ) active @endif" href="{{ route('setlocal', ['locale'=>'en'] )}}">English</a></li>
            <li><a class="dropdown-item @if($locale == 'es' ) active @endif" href="{{ route('setlocal', ['locale'=>'es'] )}}">Spanish</a></li>
          </ul>
        </div>

        <div>
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gear-fill"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="{{route('user.profile')}}">Profile</a></li>
            <li><a class="dropdown-item" href="{{route('user.changepassword')}}">Change Password</a></li>
            <li><a class="dropdown-item" href="{{route('user.album')}}">Albums</a></li>
            <li><a class="dropdown-item" href="{{route('user.logout')}}">Logout</a></li>
          </ul>
        </div>



      </div>
    </div>

  </nav>


  @yield('mainsection')




</body>

</html>