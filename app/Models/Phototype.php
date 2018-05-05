<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Photo;

class Phototype extends Model
{
    protected $table = 'phototype';
    protected $primaryKey = 'id';
    
    protected $fillable = [
       'type', 'user_id'
    ];
    
    public function user()
    {
        return $this ->belongsTo(User::class);
    }
    
    public function photo()
    {
        return $this ->hasMany(Photo::class);
    }
}
