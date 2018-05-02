<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this ->middleware('auth', ['except' => [
            'show',
        ]]);
    }
    
    public function all()
    {
        $users = User::all() ->where('id', '!=', \Auth::id());
        
        return view('users.all', compact('users'));
    }
    
    public function show(User $user)
    {
        return view('users.index', compact('user'));
    }
    
    public function edit(User $user)
    {
        $this ->authorize('update', $user);
        
        return view('users.edit', compact('user'));
    }
    
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        
        $data = $request->all();
        
        $level = $data['level'];
      
        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        } else {
            if ( $level ) {
                $data['avatar'] = 'http://www.larabbs.com/images/man.png';
            } else {
                $data['avatar'] = 'http://www.larabbs.com/images/woman.jpg';
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
    
    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        
        $title = '关注的人';
        
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        
        $title = '粉丝';
        
        return view('users.show_follow', compact('users', 'title'));
    }
}
