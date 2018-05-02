@if ($user->id !== Auth::user()->id)
<div class="panel panel-default">
<div class="panel-body">
  <div id="follow_form">
    @if (Auth::user()->isFollowing($user->id))
      <form action="{{ route('followers.destroy', $user->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-default btn-block"><span class="glyphicon glyphicon-heart"></span> 取消关注</button>
      </form>
    @else
      <form action="{{ route('followers.store', $user->id) }}" method="post">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-heart"></span> 点击关注作者</button>
      </form>
    @endif
  </div>
</div>
</div>
@endif