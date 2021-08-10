<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $table = 'verify_users';
    public $timestamps = true;
    protected $fillable = [
        'id', 'user_id', 'token',
    ];

    const RESPONSE_SUCCESS_AGAIN = 2; //"Your e-mail is already verified. You can now login.";
    const RESPONSE_SUCCESS = 1; //"Your e-mail is verified. You can now login.";
    const RESPONSE_FAIL = 0; //"Sorry your email cannot be identified.";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
