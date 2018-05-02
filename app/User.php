<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Topic;
use App\Models\Reply;
use App\Models\Zan;
use App\Models\Bookmark;
use Auth;
use App\Models\Replyzans;

class User extends Authenticatable
{
    use Notifiable {
        notify as protected laravelNotify;
    }
    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*
     * 令牌
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
   
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
    
    public function zan()
    {
        return $this ->hasOne(Zan::class);
    }
    
    public function replyzan()
    {
        return $this ->hasOne(Replyzans::class);
    }
    
    public function bookmark()
    {
        return $this ->hasMany(Bookmark::class);
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }
    
    public function follow($user_id)
    {
        if (!is_array($user_id)) {
            $user_ids = compact('user_id');
        }
        $this->followings()->sync($user_id, false);
    }

    public function unfollow($user_id)
    {
        if (!is_array($user_id)) {
            $user_ids = compact('user_id');
        }
        $this->followings()->detach($user_id);
    }
    
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
