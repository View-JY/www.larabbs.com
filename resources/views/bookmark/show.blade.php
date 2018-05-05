@extends('layouts.app')

@section('title', '我的收藏')

@section('content')


<div class="container" style="background: #FFF;">

<div class="panel-body">
    <div class="alert alert-success" role="alert">这里是我收藏的文章</div>
    
    @if (Auth::check() && count($topics) )
    <ul class="media-list">
        @foreach ($topics as $topic)
            <li class="meta" style="position: relative; min-height: 150px; padding: 15px 2px 15px 0; border-bottom: 1px solid #f0f0f0; word-wrap: break-word;">
                @if(isset($topic ->topic ->showimg))
                <a href="{{ route('users.show', [$topic ->topic ->user_id]) }}" class="" style="display: block; width: 120px; height: 120px; position: absolute; top: 50%; margin-top: -60px; right: 5px; right: 230px;">
                    <img src="{{ $topic ->topic->showimg }}" title="{{ $topic ->topic->showimg }}" style="display: block; width: 100%; height: 100%; border-radius: 4px; border: 1px solid #f0f0f0;">
                </a>
                @endif
                <div class="meta-content" style="padding-right: 360px;">
                    <div class="auth" style="margin-bottom: 15px; font-size: 12px;">
                        @if($topic ->topic->user->avatar)
                        <a class="avatar" target="_blank" href="{{ route('users.show', [$topic ->topic ->user_id]) }}">
                            <img src="{{ $topic ->topic->user->avatar }}" alt="64" style="display: inline-block; width: 32px; height: 32px; margin-right: 5px; border-radius: 50%;" data-toggle="tooltip" data-placement="left" title="{{ $topic ->topic->user->introduction }}">
                        </a>
                        @endif
                        <div class="info" style="display: inline-block; vertical-align: middle;">
                            <a class="nickname" target="_blank" href="{{ route('users.show', [$topic ->topic->user_id]) }}" style="vertical-align: middle; margin-right: 5px;">{{ $topic ->topic->user->name }}</a>
                            <span class="time">{{ $topic ->topic ->created_at }}</span>
                        </div>
                    </div>

                    <a class="title" target="_blank" href="{{ route('topics.show', [$topic->id]) }}" title="{{ $topic ->topic->user->name }}" style="font-size: 18px; line-height: 1.5; font-weight: 700; color: #333;">{{ $topic ->topic ->title }}</a>

                    <p class="abstract" style="font-size: 12px; line-height: 24px; margin: 0 0 8px;">
                        {{ $topic ->topic ->excerpt }}
                    </p>

                    <div class="" style="font-size: 12px; line-height: 20px;">
                        <a href="{{ route('categories.show', $topic ->topic->category->id) }}" title="{{ $topic ->topic->category->name }}" style="margin-right: 5px; line-height: 20px;">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                             {{ $topic ->topic->category->name }}
                        </a>
                        <a href="{{ route('topics.show', [$topic->id]) }}" title="评论数" style="margin-right: 5px; line-height: 20px;">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            {{ $topic ->topic->reply_count }}
                        </a>
                        <a href="{{ route('zans.show', $topic ->id) }}" title="点赞数" style="margin-right: 5px; line-height: 20px;">
                            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                            {{ $topic ->topic->zans_count }}
                        </a>
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        <span class="timeago" title="最后活跃于" style="margin-right: 5px; line-height: 20px;">{{ $topic ->topic->updated_at->diffForHumans() }}</span>     
                    </div>
                </div>
                <a href="{{ route('topics.unbookmark', $topic -> topic ->id) }}" class="btn btn-default" style="position: absolute; right: 10px; top: 50%; margin-top: -18px; z-index: 100;">取消收藏</a>
            </li>
        @endforeach
    </ul>
    @else
    <div class="empty-block">
        @include('layouts._empty')
    </div>
    @endif

@section('script')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection
</div>
</div>
@stop