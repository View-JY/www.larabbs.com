@extends('layouts.app')

@section('title')
我的通知 
@stop

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="page-header">
                        <h1>这里是我的未读回复</h1>
                    </div>
                    

                    @if ($notifications->count())

                        <div class="notification-list">
                            @foreach ($notifications as $notification)
                                @include('notifications.types._' . snake_case(class_basename($notification->type)))
                            @endforeach

                            {!! $notifications->render() !!}
                        </div>

                    @else
                        <div class="empty-block">没有消息通知！</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@stop