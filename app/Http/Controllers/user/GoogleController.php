<?php
  
namespace App\Http\Controllers\User;
  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        //dd();
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
              // google data
            $user = Socialite::driver('google')->user();

            //dd($user);
           
            $finduser = User::Where('email', $user->email )->first();
       
          // dd($finduser); // first() = object, first()->toArray() ->array conversion
                             // get()  = array

            if($finduser){

               
                    User::where('id',$finduser->id)->update(['google_id'=> $user->id]);

                    Auth::guard('user')->login($finduser);
        
                    Session::flash('message-success', 'User logged in successfully');
                    return redirect()->route('user.profile');
              
       
            }else{

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    
                ]);
      
                Auth::guard('user')->login($newUser);
      
                Session::flash('message-success', 'User logged in successfully');
                return redirect()->route('user.profile');
            }
      
        } catch (Exception $e) {
            Session::flash('message-error', 'User is not logged in successfully');
            return redirect()->route('user.signin');
            //dd($e->getMessage());
        }
    }
}
