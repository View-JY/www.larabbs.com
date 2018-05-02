<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Topic;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this ->middleware('auth', ['except' => [
            'index'
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all() ->where('id', '!=', \Auth::id());
        $topics = Topic::all();
        $categories = Category::orderBy(\DB::raw('RAND()')) ->take(5) ->get();;
        
        return view('home.index', compact('users', 'topics', 'categories'));
    }
 
    
}
