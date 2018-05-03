@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div align="center">
                        @if($user ->avatar)
                        <img class="thumbnail img-responsive" src="{{ $user ->avatar }}" width="300px" height="300px">
                        @else
                            @if($user ->level == 1)
                            <img class="thumbnail img-responsive" src="http://www.larabbs.com/images/man.png" width="300px" height="300px">
                            @else
                            <img class="thumbnail img-responsive" src="http://www.larabbs.com/images/woman.jpg" width="300px" height="300px">
                            @endif
                        @endif
                    </div>
                    
                    <div class="stats">
                        <a href="{{ route('users.followings', $user->id) }}">
                          <strong id="following" class="stat">
                            {{ count($user->followings) }}
                          </strong>
                          关注
                        </a>
                        <a href="{{ route('users.followers', $user->id) }}">
                          <strong id="followers" class="stat">
                            {{ count($user->followers) }}
                          </strong>
                          粉丝
                        </a>
                        <a href="#">
                          <strong id="followers" class="stat">
                            {{ $user->replies()->with('topic')->recent() ->count() }}
                          </strong>
                          话题
                        </a>
                     </div>
                    
                    <div class="media-body">
                        <hr>
                        <h4><strong>个人简介</strong></h4>
                        @if($user ->introduction)
                        <p>{{ $user ->introduction }}</p>
                        @else
                        <p>这家伙很懒,什么也没留下......</p>
                        @endif
                        <hr>
                        <h4><strong>注册于</strong></h4>
                        <p>{{ $user ->created_at ->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        @if (Auth::check())
            @include('users.follow_form')
        @endif
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