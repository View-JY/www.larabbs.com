<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Topic;
use App\User;

class BookMarksController extends Controller
{
    public function __construct() {
        $this ->middleware('auth');
    }
    
    public function show(User $user)
    {
        $topics = $user ->bookmark() ->paginate(10);
        
        return view('bookmark.show', compact('topics'));
    }
}
