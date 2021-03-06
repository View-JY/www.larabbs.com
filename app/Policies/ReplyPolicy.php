<?php

namespace App\Policies;

use App\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function update(User $user, Reply $reply)
    {
        return $reply->user_id == $user->id;
    }

    public function destroy(User $user, Reply $reply)
    {
         return $reply->user_id == $user->id;
    }
}
