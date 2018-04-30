@extends('layouts.app')

@section('title', $topic ->user ->name . ' 的赞')

@section('content')
    <div class="alert alert-success" role="alert">在这里可以看到谁赞了你</div>
    
    <ul class="list-group">
        @if($zans ->count())
        @foreach($zans as $zan)
        <li class="list-group-item" style="position: relative; padding-left: 60px;">
            @if($zan ->user ->avatar)
            <img src="{{$zan ->user ->avatar}}" style="display: inline-block; width: 32px; height: 32px; border-radius: 50%; border: 1px solid #f0f0f0; position: absolute; left: 10px; top: 50%; margin-top: -16px; z-index: 10;">
            @endif
            <a href="{{ route('users.show', $zan ->user ->id) }}" style="font-size: 12px; vertical-align: middle;">
                {{ $zan ->user ->name }}
            </a>
        </li>
        @endforeach
        @else
        <li class="list-group-item" style="position: relative; padding-left: 60px;">
            暂无数据
        </li>
        @endif
    </ul>

    {!! $zans->render() !!}
@stop