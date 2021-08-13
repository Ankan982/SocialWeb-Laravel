<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\postService;
use Exception;
use Illuminate\Http\Request;


class LikeController extends Controller
{

    protected $postService;

    public function __construct(postService $postService)
    {

        $this->postService = $postService;
    }


    public function likePost($post_id)
    {
        $user_id = auth()->user()->id;
        //dd($post_id, $user_id);
        $search = $this->postService->search($post_id, $user_id);

        if ($search) {
            try {

                $disLiked = $this->postService->disLike($post_id, $user_id);

                if ($disLiked) {
                    return redirect()->back()->with('message-success', 'Post has been disliked successfully.');
                } else {
                    return redirect()->back()->with('message-error', 'Dislike has a problem here!');
                }
            } catch (Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->with('message-error', 'Something Went Wrong. Please try after some time');
            }
        } else {

            try {

                $liked = $this->postService->createLike($post_id, $user_id);

                if ($liked) {
                    return redirect()->back()->with('message-success', 'Post has been liked successfully.');
                } else {
                    return redirect()->back()->with('message-error', 'Like has a problem here!');
                }
            } catch (Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->with('message-error', 'Something Went Wrong. Please try after some time');
            }
        }
    }
}
