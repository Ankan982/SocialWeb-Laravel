<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    protected $table = 'password_resets';
    
    public $timestamps = true;
    protected $fillable = [
        'id', 'email', 'token','status'
    ];


   
}
