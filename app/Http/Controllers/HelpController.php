<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReplyRequest;
use App\User;
use App\Handlers\ImageUploadHandler;
use Auth;
use App\Models\Help;

class HelpController extends Controller
{
    public function __construct()
    {
        $this ->middleware('auth');
    }
    
    public function index()
    {
        return view('help.index');
    }
    
    public function create(ReplyRequest $request, ImageUploadHandler $uploader, Help $help)
    {
        $data = $request->all();    
        
        if ($request->image) {
            $result = $uploader->save($request->image, 'image', Auth::id(), 362);
            if ($result) {
                $data['image'] = $result['path'];
            }
        }
        
        if ( Auth::check() ) {
            $data['user_id'] = Auth::id();
        }
        
        $help->create($data);
        
        return back() ->with('success', '谢谢您对我们工作的支持!');
    }
}
