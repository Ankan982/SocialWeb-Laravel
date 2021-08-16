<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Events\Message;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\ChatService;
use App\Services\UserService;




class ChatController extends Controller
{

    protected  $chatService,$userService;

    public function __construct(ChatService $chatService, UserService $userService)
    {
        $this->chatService = $chatService;
        $this->userService = $userService;

    }




    public function index()
    {
        $all_message = $this->chatService->findAll();
        $user_id = auth()->user()->id;
        $userdetails = $this->userService->userDetailsById($user_id);
        $username = $userdetails->name;

      // dd($username->name);
        return view('user.chat', compact('all_message', 'username'));
    }
    public function sendMessage(Request $request)
    {
        $user_id = auth()->user()->id;
        $userdetails = $this->userService->userDetailsById($user_id);
        $username = $userdetails->name;
        
        event(new Message(
            $username,
            $request->input('message')
        ));

        $dateTime =  Carbon::now()->toDateTimeString();

        $data =[
          
            'user_id' => $user_id,
            'message' =>  $request->input('message'),
            'created_at' => $dateTime,
            'updated_at' => $dateTime
            
        ];
      
         $this->chatService->create($data);


        return ['success' => true];
    }
}
