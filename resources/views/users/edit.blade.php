@extends('layouts.app')

@section('link')
<link href="{{ asset('css/fileinput.min.css') }}" rel="stylesheet">
@endsection;

@section('content')

<div class="container" style="margin-top: 85px;">
    <div class="panel panel-default col-md-10 col-md-offset-1">

        <div class="panel-body" style="padding-top: 35px;">
            
            <div class="jumbotron">
                <h1>Hello, {{ $user ->name }}!</h1>
                <p>在这里你可以编辑你的个人信息, 用于向全世界展示</p>
            </div>
            
            @include('common.errors')
            
            <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name-field">用户名</label>
                    <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name ) }}" />
                </div>
                <div class="form-group">
                    <label for="email-field">邮 箱</label>
                    <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email ) }}" />
                </div>
                <div class="form-group">
                    <label for="introduction-field">个人简介</label>
                    <textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction ) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="introduction-field">上传头像</label>
                    <div class="form-group">
                        <input id="file-Portrait" class="file" type="file" name="avatar">
                    </div>
                </div>
                <div class="form-group">
                    <label for="introduction-field">性别</label>
                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="level" id="inlineRadio1" value="1" {{ $user->level == 1 ? 'checked' : '' }}/> 男
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="level" id="inlineRadio2" value="0" {{ $user->level == 0 ? 'checked' : '' }}/> 女
                        </label>
                    </div>
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-success">点击保存个人信息</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
<script src="{{ asset('js/fileinput.min.js') }}"></script>
<script src="{{ asset('js/fileinput_locale_zh.js') }}"></script>
<script>
    // Bootstrap FileInput
    function initFileInput(ctrlName, uploadUrl) {    
        var control = $('#' + ctrlName); 
        control.fileinput({
            language: 'zh', //设置语言
            enctype: 'multipart/form-data',
            uploadUrl: uploadUrl, //上传的地址
            allowedFileExtensions : ['jpg', 'png','gif'],//接收的文件后缀
            showUpload: false, //是否显示上传按钮
            showCaption: true,//是否显示标题
            browseClass: "btn btn-success", //按钮样式             
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>", 
            msgFilesTooMany: 1,
            dropZoneEnabled: false
        });
    }
    // 调用
    initFileInput("file-Portrait", "{{route('users.update', Auth::id())}}");
</script>
@endsection;

