@extends('layouts.app')
@section('title', '首页')

@section('link')
<link href="{{ asset('css/fileinput.min.css') }}" rel="stylesheet">
@endsection;

@section('content')
<div class="row">
    <div class="panel-body col-md-8">
        <div class="page-header">
            <h1>意见反馈 <small>感谢您留给我们最宝贵的意见</small></h1>
        </div>
        
        @include('common.errors')
    
        <form class="" role="search" method="post" action="{{ route('help.create') }}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label style="margin-right: 15px; cursor: pointer;">
                    <input type="radio" name="type" value="1" required> 内容意见
                </label>
                <label style="margin-right: 15px; cursor: pointer;">
                    <input type="radio" name="type" value="2" required> 产品建议
                </label>
                <label style="margin-right: 15px; cursor: pointer;">
                    <input type="radio" name="type" value="3" required> 技术问题  
                </label>
                <label style="margin-right: 15px; cursor: pointer;" >
                    <input type="radio" name="type" value="0" required> 其它
                </label>
            </div>

            <div class="form-group">
                <label>意见与反馈</label>
                <textarea class="form-control" rows="3" name="content" placeholder="请填写具体内容帮助我们了解您的意见与建议。" required></textarea>
            </div>

            <div class="form-group">
                <label>图片</label>
                <!--<input id="file-Portrait" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2" name="image[]">-->
                <input id="file-Portrait" type="file" class="file" data-overwrite-initial="false" data-min-file-count="1" name="image">
            </div>
            
            <div class="form-group">
                <label>联系方式</label>
                <input type="telphone" class="form-control" placeholder="Text input" name="tel" required>
            </div>
            
            <div class="form-group">
                <label>相关页面地址</label>
                <input type="text" class="form-control" placeholder="Text input" name="address" required>
            </div>
            
            <button type="submit" class="btn btn-success pull-right btn-lg">点击提交</button>
        </form>
    </div>
</div>

@include('help.my')
@stop

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
            msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
            dropZoneEnabled: false,
            maxFileCount: 1,
            uploadAsync: false,
        });
    }
    // 调用
    initFileInput("file-Portrait", "{{route('users.update', Auth::id())}}");
</script>
@endsection;


