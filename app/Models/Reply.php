<?php

namespace App\Models;

use App\Models\Topic;
use App\User;
use App\Models\Replyzans;

class Reply extends Model
{
    protected $fillable = ['topic_id', 'user_id', 'content'];
    
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // 和用户进行关联
    public function replyzan($user_id)
    {
        return $this ->hasOne(Replyzans::class) ->where('user_id', $user_id);
    }
    
    // 和文章进行关联
    public function replyzans()
    {
        return $this ->hasMany(Replyzans::class);
    }
}
