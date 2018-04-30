<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Zan extends Model
{
    protected $table = 'zans';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id', 'topic_id'
    ];
    
    public function user()
    {
        return $this ->belongsTo(User::class);
    }
}
