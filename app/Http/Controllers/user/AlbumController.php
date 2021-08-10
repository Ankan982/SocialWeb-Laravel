<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\AlbumDetail;
use App\Models\Post;
use Illuminate\Http\Request;


class AlbumController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $album_details = AlbumDetail::where('user_id',$user_id)->get();
        return view('user.album', compact('album_details'));
    }

    public function show($id)
    {

        $album_info = AlbumDetail::where('id',$id)->get();
        $album_details = Post::with('allPosts')->where('album_id',$id)->get();
       // dd($album_info);
        return view('user.albumdetails', compact('album_details', 'album_info'));
    }

    public function create()
    {
        return view('user.createalbum');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg'
        ]);

        try {

            $user_id = auth()->user()->id;
            $data = $request->all();

             ///dd($data);


            if ($request->hasfile('images')) {
                $images = $request->file('images');

                foreach ($images as $image) {
                    $name = $image->getClientOriginalName();

                    $path = $image->storeAs('public/albums', $name);

                    $path = 'storage/albums/' . $name;

                    $save = new AlbumDetail;

                    $save->user_id = $user_id;
                    $save->album_name = $data['album_name'];
                    $save->cover_image = $path;

                    $save->save();
                }
            }
        

            return redirect()->route('user.home')->with('message-success', 'Album has been created successfully.');

        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('message-error', 'Something went Wrong');
        }
    }
}
