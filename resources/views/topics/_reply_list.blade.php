<div class="reply-list">
    @if($replies ->count())
    @foreach ($replies as $index => $reply)
        <div class=" media"  name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
            <div class="avatar pull-left">
                <a href="{{ route('users.show', [$reply->user_id]) }}">
                @if(isset($reply->user->avatar))
                <img class="media-object img-thumbnail" alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar }}"  style="width:48px;height:48px;"/>
                @endif
                </a>
            </div>

            <div class="infos" style="position: relative;">
                <div class="media-heading">
                    <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{ $reply->user->name }}">
                    {{ $reply->user->name }}
                    </a>
                    
                    <p class="meta" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</p>

                    {{-- 回复删除按钮 --}}
                    @can('destroy', $reply)
                    <span class="meta" style="position: absolute; top: 50%; right: 10px; z-index:1000; margin-top: -17px;">
                        <form action="{{ route('replies.destroy', $reply->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default" style="border: 0 none; outline: 0 none;">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </form>
                    </span>
                    @endcan
                    
                </div>
                <div class="reply-content">
                    {!! $reply->content !!} 
                </div>
                
                @if(Auth::id() !== $reply ->user ->id)
                <div>
                    @if($reply ->replyzan(Auth::id()) ->exists())
                    <a href="{{ route('replies.unreplyzan', $reply ->id) }}" style="color: #999 !important; margin-right: 5px;"><span class="glyphicon glyphicon-heart"></span> 取消赞</a>
                    @else
                    <a href="{{ route('replies.replyzan', $reply ->id) }}" style="color: #259d6d !important; margin-right: 5px;"><span class="glyphicon glyphicon-heart"></span> 赞</a>
                    @endif
                    
                    <a href="#" style=""><span class=""></span> 举报</a>
                </div>
                @endif
               
            </div>
        </div>
        <hr>
    @endforeach
    
    @else
        @include('layouts._empty')
    @endif
</div>


@section('script')
    <script>
    
    </script>
@endsection