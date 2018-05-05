@if (count($replies))

<ul class="list-group">
    @if(Auth::check())
        @foreach ($replies as $reply)
            <li class="list-group-item">
                <div class="reply-content" style="margin: 6px 0;">
                    {!! $reply->content !!}
                </div>

                <div class="meta">
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span> 回复于 {{ $reply->created_at->diffForHumans() }}
                </div>
            </li>
        @endforeach
    @else
        <li class="list-group-item">
            <a href="{{ route('login') }}">
                登录之后才能看偶~~赶快登录吧
            </a>
        </li>
    @endif
</ul>

@else
<div class="empty-block">
    @include('layouts._empty')
</div>
@endif

{{-- 分页 --}}
{!! $replies->appends(Request::except('page'))->render() !!}