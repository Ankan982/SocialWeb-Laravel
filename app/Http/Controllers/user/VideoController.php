<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoPost;
use App\Models\AlbumDetail;
use App\Models\Video;
use App\Services\postService;
use App\Services\VideoService;
use Exception;

use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{

    public function __construct(VideoService $VideoService,postService $postService)
    {
        $this->VideoService = $VideoService;
        $this->postService = $postService;
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $album_detils = AlbumDetail::where('user_id',$user_id)->get();
        return view('user.video', compact('album_detils'));
     
    }

    public function upload(VideoPost $request)
    {
        
        try {

            $user_id = auth()->user()->id;
            $data = $request->all();
           // dd($data);

           if(array_key_exists("album_id",$data))
           {
            $post = [];
            $post['user_id'] = $user_id;
            $post['album_id'] = $data['album_id'];
            $post['privacy'] = $data['privacy'];
           }
           else{
            $post = [];
            $post['user_id'] = $user_id;
            $post['privacy'] = $data['privacy'];
           }
           
           
            DB::beginTransaction();
            $post_details = $this->postService->create($post);

            $post_id = $post_details->id;

            if ($request->hasfile('video')) {
                $video = $request->file('video');

           
                    $name = $video->getClientOriginalName();

                    $path = $video->storeAs('public/videos', $name);

                    $path = 'storage/videos/' . $name;

                    $save = new Video;

                    $save->post_id = $post_id;
                    $save->caption = $data['caption'];
                    $save->video_path = $path;

                    $save->save();
                
            }
            DB::commit();

            return redirect()->route('user.home')->with('message-success', 'Video has been uploaded successfully.');

        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('message-error', 'Something went Wrong');
        }
    }





}
