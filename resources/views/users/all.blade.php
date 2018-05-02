@extends('layouts.app')

@section('content')

<div class="row"style="margin-left: -15px; margin-right: -15px; width: 990px; margin: 0 auto;">
    @if(count($users))
        @foreach($users as $user)
        <div class="col-xs-4">
            <div class="wrap"style="height: 320px;margin-top: 80px;padding: 0 20px;border: 1px solid #e6e6e6;  border-radius: 4px; background-color: hsla(0,0%,71%,.1);transition: .2s ease; -webkit-transition: .2s ease;-moz-transition: .2s ease; -o-transition: .2s ease; -ms-transition: .2s ease;">
                <a target="_blank" href="{{ route('users.show', $user ->id) }}" style="text-align: center; display: block;">
                    <img class="avatar" src="{{ $user ->avatar }}" alt="180" style="border-radius: 50%; width: 80px; height: 80px;margin: -40px auto 10px; text-align: center; display: inline-block; border: 1px solid #ddd; background-color: #fff;">
                    <h4 class="name"style="font-size: 21px;font-weight: 700; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                      {{ $user ->name }}
                      <i class="iconfont ic-man"></i>
                    </h4>
                    <p class="description"style="min-height: 50px;margin: 0 auto; max-width: 180px; font-size: 13px;line-height: 25px;">{{ $user ->introduction }}</p>
                </a>
                <a class="btn btn-success follow" style="margin: 0 auto; text-align: center; display: block;"><i class="iconfont ic-follow"></i><span>关注</span></a>
                <hr>
                <div class="meta" style="float: left;margin-top: -29px; padding-right: 10px;font-size: 12px;color: #969696; background-color: rgba(181, 181, 181, 0.098);">最近更新</div>
                <div class="recent-update"style="min-height: 75px;">
                    @foreach($user ->topics as $topic)
                        <a class="new" target="_blank" href="{{ route('topics.show', $topic ->id) }}" style="font-size: 13px; line-height: 25px;overflow: hidden; text-overflow: ellipsis;white-space: nowrap;display: block;">{{ $topic ->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection;

