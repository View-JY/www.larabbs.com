@extends('layouts.app')
@section('title', '首页')

@section('content')
<div class="error"style="width: 100%; max-width: 1440px; margin: 0 auto; text-align: center;">
    <div class="error-block" style="padding-top: 80px; padding-bottom: 20px;">
        <img class="main-img" src="{{ asset('images/404.jpg') }}" alt="Img 404" style="width: 220px;">
        <h3 style="margin: 40px 0 20px 0;">您要找的页面不存在</h3>
        <div class="sub-title" style="margin: 10px 0 30px 0; font-size: 12px;">可能是因为您的链接地址有误、该文章已经被作者删除或转为私密状态。</div>
        <a class="btn btn-success" href="{{ url('/') }}">点击返回「viewjy」首页</a>
    </div>     
</div>
@stop