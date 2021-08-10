<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class FriendController extends Controller
{
    protected $userService,$postService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $friend_list = $this->userService->friendsList($user_id);
        //dd($friend_list);
        return view('user.friend', compact('friend_list'));
    }
}
