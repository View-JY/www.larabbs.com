@extends('layouts.app')
@section('title', '我的相册')

@section('link')
<link href="{{ asset('css/fileinput.min.css') }}" rel="stylesheet">
@endsection;

@section('content')
<div class="row">
    
    <ol class="breadcrumb">
        <li><a href="{{ route('photos.index') }}">新建相册分类</a></li>
        <li><span>{{ $phototype ->type }}</span></li>
    </ol>

    
    @if(isset($photos))
        @foreach($photos as $photo)
        <div class="col-xs-2" style="height: 246.5px; margin-bottom: 10px;">
            <div class="thumbnail" style="height: 246.5px; line-height:246.5px; text-align: center; position: relative;">
                <img src="{{ $photo ->photo }}" data-id="{{ $photo ->id }}" alt="..." style="">
                <a class="glyphicon glyphicon-remove" href="{{ route('photos.deletephoto', $photo ->id) }}" style="position: absolute; top: 10px; right: 10px; z-index: 100; cursor: pointer; color: #000; text-decoration: none;"></a>
                <a class="glyphicon glyphicon-download-alt" href="{{ route('photos.downphoto', $photo ->photo) }}" style="position: absolute; top: 10px; left: 10px; z-index: 100; cursor: pointer; color: #000; text-decoration: none;"></a>
            </div>
        </div>
        @endforeach
    @else 
        <div class="find-nothing" style="margin: 150px 0; text-align: center;">
            <img src="http://www.larabbs.com/images/empty.png" style="width: 100px;">
            <div style="margin-top: 20px; font-size: 14px; font-weight: 700;">还没有照片欧~快去添加照片吧~</div>
        </div>
    @endif
</div>

 @if($phototype ->user ->id == Auth::id())
 <form class="" role="search" method="post" action="{{ route('photos.create') }}" accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <input type="hidden" name="phototype_id" value="{{ $phototype ->id }}" />

    <div class="form-group">
        <label>添加照片</label>
        <input id="file-Portrait" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2" name="photo[]" required>
        <!--<input id="file-Portrait" type="file" class="file" data-overwrite-initial="false" data-min-file-count="1" name="image">-->
    </div>

    <button type="submit" class="btn btn-success btn-lg">上传图片</button>
</form>
 @endif
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
            maxFileCount: 4,
            uploadAsync: false,
        });
    }
    // 调用
    initFileInput("file-Portrait", "{{route('users.update', Auth::id())}}");
</script>
@endsection;


