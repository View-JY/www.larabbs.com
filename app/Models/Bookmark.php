<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bookmark;
use App\User;
use App\Models\Topic;


class Bookmark extends Model
{
    protected $table = 'bookmarks';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id', 'topic_id'
    ];
    
    public function user()
    {
        return $this ->belongsTo(User::class);
    }
    
    public function topic()
    {
        return $this ->belongsTo(Topic::class);
    }
}
