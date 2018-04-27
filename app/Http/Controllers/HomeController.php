<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
     * 主页展示逻辑
     */
    public function index()
    {
        return view('home.index');
    }
}
