<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('users.index', compact('user'));
    }
    
    public function edit()
    {
        
    }
    
    public function update()
    {
        
    }
}
