<?php

namespace App\Services;


use App\Models\ResetPassword;

use Illuminate\Support\Arr;

class ResetService
{
    protected $resetpassword;

    public function __construct(ResetPassword $reset_password)
    {
        $this->resetpassword = $reset_password;
    }
   
    /**
     * Find the valid token
     * @return object
     */

    public function findOne($where =[])
    {
        return $this->resetpassword::where($where)->first();
    }

    public function update($attributes, $id)
    {
        $set_users_data = Arr::except($attributes, ['_token', '_method'] );
        $user = $this->resetpassword->find($id);
        return $user->update($set_users_data);
    }
}
