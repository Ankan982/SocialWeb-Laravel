<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'caption',
        'image_path',
        'video_path'
    ];

    public function postdetailsToPost()
   {
    return $this->belongsTo(Post::class, 'post_id', 'id');
   }
}
