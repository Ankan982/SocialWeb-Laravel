<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Mail\VerifyEmail;
use App\Models\VerifyUser;
use App\Services\postService;
use App\Rules\MatchOldPassword;
use Exception;


use App\Http\Requests\LoginUser;
use App\Http\Requests\RegisterUser;

class UserController extends Controller
{
    protected $userService, $postService;

    public function __construct(UserService $userService, postService $postService)
    {
        $this->userService = $userService;
        $this->postService = $postService;
    }


    public function index()
    {
        $all_posts = $this->postService->findAllPost();
        // dd($all_posts);
        return view('user.homeifNotLogin', compact('all_posts'));
    }

    public function home()
    {
        $user_id = auth()->user()->id;
        $all_posts = $this->postService->findAll($user_id);

        //dd($all_posts);
        return view('user.homeifLogin', compact('all_posts', 'user_id'));
    }
    public function signup()
    {
        return view('user.registration');
    }
    public function signin()
    {
        return view('user.login');
    }
    public function chnagePassword()
    {
        return view('user.changepassword');
    }


    public function profile()
    {
        $user = auth()->user();
        $user_id = auth()->user()->id;
        $user_posts = $this->postService->findOne($user_id);
        //dd($user_posts);
        return view('user.profile', compact('user', 'user_posts'));
    }


    public function registerAction(RegisterUser $request)
    {

        try {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            //  dd($data);
            $user_details = $this->userService->create($data);

            $verify_users_data = [
                'user_id' => $user_details->id,
                'token' => uniqid(),
            ];

            $this->userService->createVerifyToken($verify_users_data);

            $email_data = [
                'subject' => 'Registration Email Verification Link',
                'name' => $user_details->name,
                'url' => route('user.email.verification', ['token' => $verify_users_data['token']]),
                'logopath' => '',
            ];

            Mail::to($user_details->email)->send(new VerifyEmail($email_data));

            return redirect()->route('user.signup')->with('message-success', 'Please Check Your Email. Verify Your Email');
        } catch (Exception $e) {
            //dd($e->getMessage());
            return redirect()->route('user.signup')->with('message-error', 'Something Went Wrong. Please try after some time');
        }
    }

    public function loginAction(LoginUser $request)
    {
        // server side validation is done using request class

        try {

            if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'role' => ['user']])) {

                return redirect()->route('user.homeifLogin')->with('message-success', 'User is logged in Successfully.');
            } else {

                return redirect()->back()->with('message-error', 'User is invalid');
            }
        } catch (Exception $e) {

            return redirect()->back()->with('message-error', 'Something Went Wrong. Please try after some time.');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('user.signin')->with('message-success', 'User logged out Successfully.');
    }


    public function emailVerification(Request $request)
    {
        try {
            $response = $this->userService->emailVerification($request->token);
            if ($response == VerifyUser::RESPONSE_SUCCESS) {
                return redirect()->route('user.signin')->with('message-success', 'Email has been verified successfully');
            } else if ($response == VerifyUser::RESPONSE_SUCCESS_AGAIN) {
                return redirect()->route('user.signin')->with('message-success', 'You already verify your email address');
            } else {
                return redirect()->route('user.signup')->with('message-error', 'Invalid Token');
            }
        } catch (\Exception $e) {
            return redirect()->route('user.signup')->with('message-error', 'Something Went Wrong. Please try after some time');
        }
    }


    public function profileEdit()
    {
        $user = auth()->user();
        return view('user.edituser', compact('user'));
    }

    public function ProfileEditAction(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'bio' => 'required',
        ]);


        try {

            $data = $request->all();

            $user_id = auth()->user()->id;
            $isUpatedUser = $this->userService->update($data, $user_id);
            // dd($isUpatedUser);
            if ($isUpatedUser) {
                return redirect()->route('user.profile')->with('message-success', 'User has been updated succesfully.');
            } else {

                return redirect()->back()->with('message-error', 'User is not updated.');
            }
        } catch (\Exception $e) {

            // dd($e->getMessage());
            return redirect()->back()->with('message-error', 'Something went wrong.');
        }
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        // dd($e->getMessage());

        try {

            $data = ['password' => Hash::make($request->new_password)];
            $user_id = auth()->user()->id;
            $isUpatedUser = $this->userService->update($data, $user_id);
            if ($isUpatedUser) {

                return redirect()->route('user.profile')->with('message-success', 'Password has been updated.');
            } else {

                return redirect()->back()->with('message-error', 'Password is not matched.');
            }
        } catch (\Exception $e) {
            Session::flash('message-error', 'Something Went Wrong');
            return redirect()->back();
        }
    }
}
