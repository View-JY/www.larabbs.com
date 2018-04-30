<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zan;
use \App\Models\Topic;

class ZansController extends Controller
{
    public function __controller()
    {
        $this ->middleware('auth');
    }
    
    public function show(Topic $topic, Zan $zan)
    {
        $zans = $topic ->zans() ->paginate(15);
        
        return view('zans.index', compact('topic', 'zans'));
    }
}
