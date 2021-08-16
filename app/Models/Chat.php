<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable =
    [
        'user_id',
        'message',
        'created_at',
        'updated_at'
    ];


    public function userName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
