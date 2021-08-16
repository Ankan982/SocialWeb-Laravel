<?php

namespace App\Services;

use App\Models\Chat;


use Illuminate\Support\Arr;

class ChatService
{
    protected $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }
    /**
     * Find All chat List
     * @return array
     */
    public function findAll($where = [])
    {
        return $this->chat::with('userName')->where($where)->get();
    }
     /**
     * Find All chat List
     * @return array
     */
    public function friendsList($id)
    {
        return $this->chat::where('id', '!=', $id )->get();
    }
    /**
     * Find chat Details
     * @return array
     */
    public function findOne($id)
    {
        //return DB::table('chats')->where('id', $id)->first();
        return $this->chat::with('projects', 'projects.projectDetails')->where('id', $id)->first();
    }
    /**
     * Update chat Details
     * @return array
     */
    public function update($attributes, $id)
    {
        $set_chats_data = Arr::except($attributes, ['_token', '_method']);
        $chat = $this->chat->find($id);
        return $chat->update($set_chats_data);
    }
     
    public function create($attributes)
    {
        $attributes = Arr::except($attributes, ['_token', '_method']);
        return $this->chat->create($attributes);
    }
    /**
     * Find chat Details By Email
     * @return object
     */
    public function chatDetailsByEmail($email)
    {
        return $this->chat::where('email', $email)->first();
    }

   
}
