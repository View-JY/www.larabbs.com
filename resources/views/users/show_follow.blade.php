@extends('layouts.app')
@section('title', $title)

@section('content')
<div class="alert alert-success" role="alert">我的 {{ $title }} 全在这里</div>
<div class="">
  <ul class="list-group">
      
    @if($users ->count())
        @foreach ($users as $user)
            <li class="list-group-item">
                <a href="{{ route('users.show', $user) }}">{{ $user ->name }}</a>
            </li>
        @endforeach
    @else
        <li class="list-group-item">
            <div class="find-nothing" style="margin: 150px 0; text-align: center;">
                <img src="//cdn2.jianshu.io/assets/web/icon_nocontent-00c423de394b9184d467f2f2a7284b54.png" style="width: 100px;"> 
                <div style="margin-top: 20px; font-size: 14px; font-weight: 700;">这里还木有内容哦~</div>
            </div>
        </li>
    @endif
  </ul>
  {!! $users->render() !!}
</div>
@stop