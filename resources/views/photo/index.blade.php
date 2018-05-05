@extends('layouts.app')
@section('title', '我的相册')

@section('content')
<div class="row">
    <div class="col-xs-8" style="background: #FFF;">
       @if(count($types))
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>分类名称</th>
                    <th>照片数量</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($types as $type)
                <tr>
                    <td>
                        <a href="{{ route('photos.show', ['phototype' => $type ->id]) }}" data-id="{{ $type ->id }}">{{ $type ->type }} </a>
                    </td>
                    <td>
                        <span class="badge">{{ $type ->photo_count }}</span>
                    </td>
                    <td>
                        <a href="{{ route('photos.show', ['phototype' => $type ->id]) }}" class="btn btn-success" style="color: #FFF !important;">添加照片</a>
                        <a href="{{ route('photos.deletetype', ['phototype' => $type ->id]) }}" class="btn btn-default"  style="color: #ccc !important;">删除该分类</a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        @else
            @include('layouts._empty')
        @endif
    </div>
    <div class="col-xs-4">
        <form class="navbar-form navbar-left" role="search" method="post" action="{{ route('photos.createtype') }}">
           {{ csrf_field() }}
            
            <div class="form-group">
                <input type="text" class="form-control" placeholder="新建你的照片分类吧" required name="type"/>
            </div>
            <button type="submit" class="btn btn-success">点击新建分类</button>
        </form> 
    </div>
</div>
@endsection;


    