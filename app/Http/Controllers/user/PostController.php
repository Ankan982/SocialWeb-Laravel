<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostDetail;
use App\Models\AlbumDetail;
use App\Services\PostService;
use Exception;
use App\Http\Requests\UploadPost;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    protected $userService, $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $album_detils = AlbumDetail::where('user_id',$user_id)->get();
        //dd($album_detils);
        return view('user.post', compact('album_detils'));
    }

    public function editPost($id)
    {
        $post_details = $this->postService->findPost($id);
       // dd($post_details);
        return view('user.editpost', compact('post_details'));
    }

    public function editPostAction(Request $request,$id)
    {
          $data = $request->all();
          //dd($data);
      try{
        $UpdateStatus = $this->postService->update($data,$id);

        if($UpdateStatus)
        {
            return redirect()->route('user.home')->with('message-success', 'Post has been updated successfully.');
        }
        else{
            return redirect()->back()->with('message-error', 'Post is not exists.');
        }
      }
      catch (Exception $e) {
        dd($e->getMessage());
        return redirect()->back()->with('message-error', 'Something went Wrong');
    }
      
        
    }


    public function upload(UploadPost $request)
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

            if ($request->hasfile('images')) {
                $images = $request->file('images');

                foreach ($images as $image) {
                    $name = $image->getClientOriginalName();

                    $path = $image->storeAs('public/images', $name);

                    $path = 'storage/images/' . $name;

                    $save = new PostDetail;

                    $save->post_id = $post_id;
                    $save->caption = $data['caption'];
                    $save->image_path = $path;

                    $save->save();
                }
            }
            DB::commit();

            return redirect()->route('user.home')->with('message-success', 'Post has been uploaded successfully.');

        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('message-error', 'Something went Wrong');
        }
    }

  public function deletepost($id)
  {
    try{
        $post = Post::find($id); 
        $post->delete(); 
        $post_details = PostDetail::where('post_id', $id)->get();
        $post_details->delete();

        
     }
     catch (Exception $e) {
        dd($e->getMessage());
        return redirect()->back()->with('message-error', 'Something went Wrong');
    }
  }













}
