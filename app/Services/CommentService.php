<?php

namespace App\Services;

use App\Models\post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\PostDetail;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class commentService
{
    protected $comment, $like, $post;

    public function __construct(Post $post, Like $like, Comment $comment)
    {
        $this->post = $post;
        $this->like = $like;
        $this->comment = $comment;
    }

    
    /**
     * Find All the comments of a specific post 
     * @return array
     */

    public function findAllPost($id)
    {
        return $this->comment::with('commentToUser')
        ->where('post_id', $id)->get();
    }

    /**
     * Find All post List
     * @return array
     */
    public function findAll($id)
    {
        $a = $this->post::with('allPosts', 'postToUser', 'likes')
            ->where('privacy', '!=', 'me')
            ->orderBy('created_at', 'desc')->get();

        $b = $this->post::with('allPosts', 'postToUser', 'likes')
            ->where('user_id', $id)
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
        return $this->comment->create($attributes);
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
