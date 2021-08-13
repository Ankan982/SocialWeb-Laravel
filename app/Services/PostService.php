<?php

namespace App\Services;

use App\Models\post;
use App\Models\Like;
use App\Models\PostDetail;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class postService
{
    protected $post, $like;

    public function __construct(Post $post, Like $like)
    {
        $this->post = $post;
        $this->like = $like;
    }


    public function findAllPost()
    {
        $a = $this->post::with('allPosts', 'postToUser')
            ->where('privacy', '!=', 'me')
            ->orderBy('created_at', 'desc')->get();

        return $a;
    }

    /**
     * Find All post List
     * @return array
     */
    public function findAll($userid)
    {
        $a = $this->post::with('allPosts', 'postToUser', 'likes')
            ->where('privacy', '!=', 'me')
            ->orderBy('created_at', 'desc')->get();


        $b = $this->post::with('allPosts', 'postToUser', 'likes')
            ->where('user_id', $userid)
            ->orderBy('created_at', 'desc')->get();

        $ans = $a->merge($b);
        //dd($ans); 
        return $ans;
    }
    /**
     * Insert in Like table
     * @return array
     */
    public function createLike($post_id, $user_id)
    {
        $details = [
            'user_id' => $user_id,
            'post_id' => $post_id
        ];
        // dd($details);
        return $this->like->create($details);
    }

    /**
     * Find first post Details which is liked by the auth user
     * @return object
     */
    public function search($post_id, $user_id)
    {
        return $this->like->where('user_id', $user_id)->where('post_id', $post_id)->first();
    }
    /**
     * Dislike the post by auth user
     * @return object
     */
    public function disLike($post_id, $user_id)
    {
        $likedPost = $this->like->where('user_id', $user_id)->where('post_id', $post_id)->first();
        return $likedPost->delete();
    }

    /**
     * Find post Details
     * @return array
     */
    public function findOne($id)
    {
        //return DB::table('posts')->where('id', $id)->first();
        return $this->post::with('allPosts')->where('user_id', $id)->get();
    }
    /**
     * Find specific post Details
     * @return array
     */
    public function findPost($id)
    {
        return PostDetail::with('postDetailsToPost')->where('id', $id)->get();
    }

    /**
     * Update specific post Details
     * @return array
     */
    public function update($attributes, $id)
    {
        $set_posts_data = Arr::except($attributes, ['_token', '_method']);
        // dd($set_posts_data);
        $privacy['privacy'] = $set_posts_data['privacy'];
        Post::where('id', $id)->first()->update($privacy);
        return PostDetail::where('id', $id)->first()->update($set_posts_data);
    }
    /**
     * Update password
     * @return array
     */
    public function updatePassword($password, $email)
    {
        $post = $this->post->where('email', $email);
        return $post->update(['password' => $password]);
    }
    public function create($attributes)
    {
        $attributes = Arr::except($attributes, ['_token', '_method']);
        return $this->post->create($attributes);
    }
    /**
     * Find post Details By Email
     * @return object
     */
    public function postDetailsByEmail($email)
    {
        return $this->post::where('email', $email)->first();
    }
}
