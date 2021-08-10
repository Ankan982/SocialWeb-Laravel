<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use Exception;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected $commentService;

    public function __construct(CommentService $commentService)
    {

        $this->commentService = $commentService;
    }

    public function index($id)
    {
        $posts = $this->commentService->findPost($id);
        $comments = $this->commentService->findAllPost($id);
        //dd($comments);
        return view('user.comment', compact('posts', 'comments'));
    }




    public function comment(Request $request, $post_id)
    {
        $user_id = auth()->user()->id;
        $comment = $request->input('comments');

        $data = [
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comment' => $comment
        ];

        try {

            $commented = $this->commentService->create($data);

            if ($commented) {
                return redirect()->back()->with('message-success', 'Comment has been uploaded successfully.');
            } else {
                return redirect()->back()->with('message-error', 'Comment has a problem here!');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('message-error', 'Something Went Wrong. Please try after some time');
        }



        dd($data);
    }
}
