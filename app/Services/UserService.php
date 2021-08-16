<?php

namespace App\Services;

use App\Models\User;
use App\Mail\VerifyEmail;
use App\Models\VerifyUser;
use App\Models\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class UserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Find All User List
     * @return array
     */
    public function findAll($where = [])
    {
        return $this->user::where($where)->get();
    }
     /**
     * Find All User List
     * @return array
     */
    public function friendsList($id)
    {
        return $this->user::where('id', '!=', $id )->get();
    }
    /**
     * Find User Details
     * @return array
     */
    public function findOne($id)
    {
        //return DB::table('users')->where('id', $id)->first();
        return $this->user::with('projects', 'projects.projectDetails')->where('id', $id)->first();
    }
    /**
     * Update User Details
     * @return array
     */
    public function update($attributes, $id)
    {
        $set_users_data = Arr::except($attributes, ['_token', '_method']);
        $user = $this->user->find($id);
        return $user->update($set_users_data);
    }
     /**
     * Update password
     * @return array
     */
    public function updatePassword($password, $email)
    {
        $user = $this->user->where('email',$email);
        return $user->update(['password'=>$password]);
    }
    public function create($attributes)
    {
        $attributes = Arr::except($attributes, ['_token', '_method']);
        return $this->user->create($attributes);
    }
    /**
     * Find User Details By Email
     * @return object
     */
    public function userDetailsByEmail($email)
    {
        return $this->user::where('email', $email)->first();
    }
    public function userDetailsById($id)
    {
        return $this->user::where('id', $id)->first();
    }
    public function emailVerification($token)
    {
        $response = VerifyUser::with('user')->where('token', $token)->first();
        if ($response) {
            $user = $response->user;
            if (!$user->email_verified_at) {
                $response->user->email_verified_at = Carbon::now();
                $response->user->save();
                return VerifyUser::RESPONSE_SUCCESS;
            } else {
                return VerifyUser::RESPONSE_SUCCESS_AGAIN;
            }
        } else {
            return VerifyUser::RESPONSE_FAIL;
        }
    }
    public function createVerifyToken($attributes)
    {
        return VerifyUser::create($attributes);
    }

    public function CreateResetToken($attributes)
    {
        
        return ResetPassword::create($attributes);
    }
}
