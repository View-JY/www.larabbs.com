<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;

class VisitorRegistry extends Model
{
    protected $table = 'visitor_registry';

    protected $fillable = ['clicks'];

    /**
     * 访问登记数与文章一对多的关联关系
     */
    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }
}
