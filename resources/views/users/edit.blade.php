@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 85px;">
    <div class="panel panel-default col-md-10 col-md-offset-1">

        <div class="panel-body" style="padding-top: 35px;">
            
            <div class="jumbotron">
                <h1>Hello, {{ $user ->name }}!</h1>
                <p>在这里你可以编辑你的个人信息, 用于向全世界展示</p>
            </div>
            
            @include('common.errors')
            
            <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8">
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
                <div class="well well-sm">
                    <button type="submit" class="btn btn-success">点击保存个人信息</button>
                </div>
            </form>
        </div>
    </div>
</div>

