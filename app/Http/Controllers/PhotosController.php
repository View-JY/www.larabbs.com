<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\User;
use App\Models\Phototype;
use Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PhotosController extends Controller
{
    public function __construct()
    {
        $this ->middleware('auth');
    }
    
    public function index(Phototype $phototype)
    {
        $types = Phototype::where('user_id', Auth::id()) ->withCount(['photo']) ->get();
        
        return view('photo.index', compact('types'));
    }
    
    public function show(Phototype $phototype)
    {
        $photos = $phototype ->photo ->all();
    
        return view('photo.show', compact('phototype', 'photos'));
    }

    public function create(Request $request,ImageUploadHandler $uploader, Photo $photo)
    {        
        $data = $request ->all();
        
        $photos = $data['photo'];
        
        if (count($photos) > 0) {
            foreach ($photos as $p){
                $result = $uploader->save($p, 'image', Auth::id(), 362);
                
                if ($result) {
                    $data['photo'] = $result['path'];
                }
                
                $data['user_id'] = Auth::id();
                $data['phototype_id'] = $data['phototype_id'];
                
                $photo ->create($data);
            }
        }
        
        return back() ->with('success', '图片上传成功!!!');
    }
    
    public function createtype(Request $request, Phototype $phototype)
    {
        $request = $request ->all();
        
        $validator = Validator::make($request, [
            'type' => 'required|min:2',
        ]);
        
        if ($validator->fails()) {
            return back() ->with('success', '照片分类创建失败,请在试一次');
        }
        
        $data['type'] = $request['type'];
        $data['user_id'] = Auth::id();
        
        $phototype ->create($data);
        
        return back() ->with('success', '照片分类创建成功');
    }
    
    public function deletetype(Phototype $phototype)
    {
        $photos = $phototype ->photo ->where('user_id', Auth::id());
        
        foreach ($photos as $photo){
            $photo ->delete();
        }
        
        $phototype ->delete();
        
        return back() ->with('success', '照片分类删除成功');
    }
    
    public function deletephoto(Photo $photo)
    {
        $photo ->delete();
        
        return back() ->with('success', '照片删除成功');
    }
    
    public function downphoto()
    {
        return response() ->file();
    }
}
