@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    作者：{{ $topic->user->name }}
                </div>
                <hr>
                <div class="media">
                    <div align="center">
                        <a href="{{ route('users.show', $topic->user->id) }}">
                            <img class="thumbnail img-responsive" src="{{ $topic->user->avatar }}" width="300px" height="300px">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::id() !== $topic ->user ->id)
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{ route('topics.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 关注该作者
                </a>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-center">
                    {{ $topic->title }}
                </h1>

                <div class="article-meta text-center">
                    {{ $topic->created_at->diffForHumans() }}
                    ⋅
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    {{ $topic->reply_count }}
                </div>

                <div class="topic-body">
                    {!! $topic->body !!}
                    
                    @include('common.share', [
                        'bdText' => $topic ->body,
                        'bdDesc' => $topic ->excerpt,
                        'bdUrl' => route('topics.show', $topic->id),
                        'bdPic' => $topic ->showImg
                    ])
                </div>

                @can('update', $topic)
                    <div class="operate">
                        <hr>
                        <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-success pull-left" role="button">
                            <i class="glyphicon glyphicon-edit"></i> 编辑帖子
                        </a>

                        <form action="{{ route('topics.destroy', $topic->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-success pull-left" style="margin-left: 6px">
                                <i class="glyphicon glyphicon-trash"></i>
                                删除帖子
                            </button>
                        </form>
                    </div>
                @endcan
                
                @if(Auth::id() !== $topic ->user ->id)
                    <div class="operate">
                        <hr>
                        @if($topic ->zan(Auth::id()) ->exists())
                        <a href="{{ route('topics.unzan', $topic->id) }}" class="btn btn-success pull-left" role="button">
                            <i class="glyphicon glyphicon-thumbs-up"></i> 取消赞
                        </a>
                        @else
                        <a href="{{ route('topics.zan', $topic->id) }}" class="btn btn-default pull-left" role="button">
                            <i class="glyphicon glyphicon-thumbs-up"></i> 点赞
                        </a>
                        @endif
                    </div>
                @endif

            </div>
        </div>
        
        {{-- 用户回复列表 --}}
        <div class="panel panel-default topic-reply">
            <div class="panel-body">
                @includeWhen(Auth::check(), 'topics._reply_box', ['topic' => $topic])
                @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
            </div>
        </div>
    </div>
</div>
@stop