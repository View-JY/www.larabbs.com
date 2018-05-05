<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;
use App\Models\Replyzans;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return;
    }

    public function store(ReplyRequest $request, Reply $reply)
    {
        $reply->content = $request->content;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();
        
        return redirect()->route('topics.show', $reply->topic_id)->with('success', '回复创建成功.');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        
        $reply->delete();

        return redirect()->route('topics.show', $reply->topic_id)->with('success', '回复删除成功.');
    }
    
    public function replyzan(Reply $reply)
    { 
        $params = [
            'user_id'  => Auth::id(),
            'reply_id' => $reply ->id
        ];
        
        Replyzans::firstOrCreate($params);
       
        return back();
    }
    
    public function unreplyzan(Reply $reply)
    {
        $reply ->replyzan(Auth::id()) ->delete();
        
        return back();
    }
    
 
}