<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Phototype;

class Photo extends Model
{
    protected $table = 'photos';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id', 'photo', 'phototype_id',
    ];
    
    public function user()
    {
        return $this ->belongsTo(User::class);
    }
    
    public function phototype()
    {
        return $this ->belongsTo(Phototype::class);
    }
}
