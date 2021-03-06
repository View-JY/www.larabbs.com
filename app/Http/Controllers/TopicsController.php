<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\Zan;
use App\Models\VisitorRegistry;
use App\Models\Bookmark;

class TopicsController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Topic $topic)
    {
        $topics = Topic::with('user', 'category')->withOrder($request->order)->withCount(['zans']) ->paginate(10);
        
        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic, $only = false)
    {      
        $recommend = Topic::with('user', 'category', 'replies') ->where('category_id', $topic ->category_id) ->orderBy(\DB::raw('RAND()')) ->take(10) ->get();
        
        if( request() ->get('only') == 1 ) {
            $replies = $topic ->replies()->with('user') ->only() ->orderBy('created_at', 'desc') ->get();
        } else {
            $replies = $topic ->replies()->with('user') ->orderBy('created_at', 'desc') ->get();
        }

        \Visitor::log($topic ->id); // 统计文章访问量 - 通过IP识别
        
        return view('topics.show', compact('topic', 'recommend', 'replies'));
    }
    
    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic, ImageUploadHandler $uploader)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        
        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', Auth::id(), 362);
            
            if ($result) {
                $topic->showimg = $result['path'];
            }
        }
        
        $topic->save();

        return redirect()->to($topic->link())->with('success', '成功创建话题！');
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        
        $categories = Category::all();
        
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function update(TopicRequest $request, Topic $topic, ImageUploadHandler $uploader)
    {
        $this->authorize('update', $topic);
        
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', Auth::id(), 362);
            
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        
        $topic->update($data);
        

        return redirect()->route('topics.show', $topic->id)->with('success', '帖子修改成功.');
    }

    public function destroy(Topic $topic)
    {   
        $this->authorize('destroy', $topic);
        
        $topic->delete();

        return redirect()->route('topics.index')->with('success', '帖子删除成功.');
    }
    
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }
    
    public function zan(Topic $topic)
    { 
        $params = [
            'user_id'  => Auth::id(),
            'topic_id' => $topic ->id
        ];
        
        Zan::firstOrCreate($params);
       
        return back();
    }
    
    public function unzan(Topic $topic)
    {
        $topic ->zan(Auth::id()) ->delete();
        
        return back();
    }
    
    public function bookmark(Topic $topic)
    {
        $params = [
            'user_id'  => Auth::id(),
            'topic_id' => $topic ->id
        ];
        
        Bookmark::firstOrCreate($params);
       
        return back();
    }
    
    public function unbookmark(Topic $topic)
    {
        $topic ->Bookmark(Auth::id()) ->delete();
        
        return back();
    }
}