<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Help extends Model
{
    protected $table = 'help';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id', 'content', 'type', 'image', 'tel', 'address'
    ];
    
    public function user()
    {
        return $this ->belongsTo(User::class);
    }
}
