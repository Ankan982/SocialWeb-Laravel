<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostDetail;
use App\Models\Like;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'album_id',
        'privacy'
    ];

   public function allPosts()
   {
    return $this->hasMany(PostDetail::class, 'post_id', 'id');
   }

   public function likes()
   {
    return $this->hasMany(Like::class, 'post_id', 'id');
   }

   
   public function postToUser()
   {
    return $this->belongsTo(User::class, 'user_id', 'id');
   }
   



}
