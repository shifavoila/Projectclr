<?php

namespace App\Policies\Codeclr;

use App\Models\User;
use App\Models\Codeclr\Post;


class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Post $post): bool
    {
        if($user->role == 'admin' || $post->user_id == $user->user_id)
            return true;
        else
            return false;
    }

    public function update(User $user, Post $post): bool
    {
        if($user->role == 'admin' || $post->user_id == $user->user_id)
            return true;
        else
            return false;
    }

    public function delete(User $user,Post $post): bool
    {
        if($user->role == 'admin' || $post->user_id == $user->user_id)
            return true;
        else
            return false;
            
    }
}
