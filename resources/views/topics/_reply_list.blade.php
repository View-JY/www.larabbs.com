<div class="reply-list">
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
                </div>
                @endif
               
            </div>
        </div>
        <hr>
    @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form action="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">回复</h4>
      </div>
      <div class="modal-body">
          <input type="hidden" value="" name="reply_id"/>
          
          <textarea rows="3" placeholder="写下你的想法" name="content" class="form-control" style="resize: none;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-success">点击回复</button>
      </div>
    </div>
  </div>
  </form>
</div>

@section('script')
    <script>
    
    </script>
@endsection