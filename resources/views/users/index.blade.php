@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

@if(Auth::id() !== $user ->id)
    <div class="alert alert-success" role="alert">{{ Auth::user() ->name }} 欢迎来到,{{ $user ->name }} 的主页,快来加关注吧!</div>
@endif

<div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div align="center">
                        @if($user ->avatar)
                        <img class="thumbnail img-responsive" src="{{ $user ->avatar }}" width="300px" height="300px">
                        @else
                        <img class="thumbnail img-responsive" src="https://fsdhubcdn.phphub.org/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/600/h/600" width="300px" height="300px">
                        @endif
                    </div>
                    <div class="media-body">
                        <hr>
                        <h4><strong>个人简介</strong></h4>
                        <p>{{ $user ->introduction }}</p>
                        <hr>
                        <h4><strong>注册于</strong></h4>
                        <p>{{ $user ->created_at ->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{ route('topics.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
                    <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> 点击关注作者 ☺
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <span>
                    <h1 class="panel-title pull-left" style="font-size:30px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
                </span>
                @if(Auth::id() === $user ->id)
                <a href="{{ route('users.edit', Auth::id()) }}" type="button" class="btn btn-success pull-right">
                    <span class="glyphicon glyphicon-user"></span>
                    点击编辑个人资料
                </a>
                @endif
            </div>
        </div>
        <hr>

        {{-- 用户发布的内容 --}}
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="{{ active_class(if_query('tab', null)) }}">
                        <a href="{{ route('users.show', $user->id) }}">Ta 的话题</a>
                    </li>
                    <li class="{{ active_class(if_query('tab', 'replies')) }}">
                        <a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">Ta 的回复</a>
                    </li>
                </ul>
                @if (if_query('tab', 'replies'))
                    @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
                @else
                    @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
                @endif
            </div>
        </div>

    </div>
</div>
@stop