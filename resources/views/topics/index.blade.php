@extends('layouts.app')

@section('title', isset($category) ? $category->name : '话题列表')

@section('content')

<div class="row">
    <div class="col-lg-9 col-md-9 topic-list">
        @if (isset($category))
            <div class="alert alert-success" role="alert">
                {{ $category->name }} ：{{ $category->description }}
            </div>
        @endif

        <div class="panel panel-default">

            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li class="{{ active_class(!if_query('order', 'recent') ) }}"><a href="{{ Request::url() }}?order=default">最后回复</a></li>
                    <li class="{{ active_class(if_query('order', 'recent')) }}"><a href="{{ Request::url() }}?order=recent">最新发布</a></li>
                </ul>
            </div>

            <div class="panel-body">
                {{-- 话题列表 --}}
                @include('topics._topic_list', ['topics' => $topics])
                {{-- 分页 --}}
                {!! $topics->render() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
        <div class="">
            <div class="orange" style="position: relative; background-color: #fff; text-align: center; border-radius: 4px; font-size: 14px; border: 1px solid #f0f0f0; margin-bottom: 15px; border-top: 2px solid #00b5ad; padding: 25px;">
                 这世界疯了,我也疯了......
            </div>
        </div>

        @include('topics._sidebar')
    </div>
</div>

@endsection