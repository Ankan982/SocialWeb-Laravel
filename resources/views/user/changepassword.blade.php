@extends('user.layouts.navbariflogin')

@section('mainsection')

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Password with Current Password </div>
   
                <div class="card-body mt-2">
                    <form method="POST" action="{{ route('user.newpassword')}}">
                        @csrf 
   
                        
           
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
  
                        <div class="form-group row mt-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
  
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
                        @if($errors->has('current_password'))
                        <div class="alert alert-danger mt-5" role="alert">
                          {{ $errors->first('current_password')}}
                        </div>
                        @endif

  
                        <div class="form-group row mt-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>
                        @if($errors->has('new_password'))
                        <div class="alert alert-danger mt-5" role="alert">
                          {{ $errors->first('new_password')}}
                        </div>
                        @endif
  
                        <div class="form-group row mt-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>
                        @if($errors->has('new_confirm_password'))
                        <div class="alert alert-danger mt-5" role="alert">
                          {{ $errors->first('new_confirm_password')}}
                        </div>
                        @endif
   
                        <div class="form-group row mt-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
     













@endsection