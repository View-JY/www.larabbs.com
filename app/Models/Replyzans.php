<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;

class Replyzans extends Authenticatable
{
    protected $table = 'replyzans';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id', 'reply_id'
    ];
    
    public function user()
    {
        return $this ->belongsTo(User::class);
    }
}
