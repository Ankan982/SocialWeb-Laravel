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


        // google data
        // $user = Socialite::driver('google')->user();

        $user = Socialite::driver('google')->stateless()->user();

        $finduser = User::Where('email', $user->email)->first();

        //  dd($finduser);

        if ($finduser) {

            try {

                User::where('id', $finduser->id)->update(['google_id' => $user->id]);

                Auth::guard('user')->login($finduser);

                Session::flash('message-success', 'User logged in successfully');
                return redirect()->route('user.profile');
            } catch (Exception $e) {
                Session::flash('message-error', 'User is not logged in successfully');
                return redirect()->route('user.signin');
                dd($e->getMessage());
            }
        } else {

            try {

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,

                ]);

                Auth::guard('user')->login($newUser);

                Session::flash('message-success', 'User logged in successfully');
                return redirect()->route('user.profile');
            } catch (Exception $e) {
                Session::flash('message-error', 'User is not logged in successfully');
                return redirect()->route('user.signin');
                dd($e->getMessage());
            }
        }
    }
}
