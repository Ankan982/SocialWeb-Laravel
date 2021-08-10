<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user/signinup.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>


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

    <h1 class="text-center mt-3">SocialWeb</h1>

    <div class="card bg-light mt-5">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center" >Login with Your Account</h4>
          <!--  <p>
                <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
                <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
            </p>
            <p class="text-center">
                OR
            </p>-->
            <form id="regForm" action="{{route('user.loginaction')}}" method="POST">
                @csrf
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" class="form-control" placeholder="Email address" type="email">
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="password" class="form-control" placeholder="Create password" type="password">
                </div> <!-- form-group// -->

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Sign In </button>
                </div> <!-- form-group// -->
               
            </form>
        </article>

       
    </div> <!-- card.// -->

    <p class="text-center mt-3" >Create an account <a href="{{route('user.signup')}}" > Sign Up </a> now</p>
            <p class="text-center">OR</p>
       <div class="d-flex justify-content-center mr-5">
						<a href="{{ route('user.googlepage')}}">
							<img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
						</a>
		</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>



    <script>
        $(document).ready(function() {
            $("#regForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 3,
                        maxlength: 10
                    }
                },
                messages: {
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 3 characters",
                        maxlength: "Password must be at most 10 characters",
                    }
                }
            });
        });
    </script>

</body>

</html>