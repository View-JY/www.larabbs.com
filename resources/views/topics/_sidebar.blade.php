<div class="list-group">
    <a href="{{ route('topics.index') }}" class="list-group-item {{ active_class(if_route('topics.index')) }}">
      话题
    </a>
    <a href="{{ route('categories.show', 1) }}" class="list-group-item {{ active_class((if_route('categories.show') && if_route_param('category', 1))) }}">分享</a>
    <a href="{{ route('categories.show', 2) }}" class="list-group-item {{ active_class((if_route('categories.show') && if_route_param('category', 2))) }}">教程</a>
    <a href="{{ route('categories.show', 3) }}" class="list-group-item {{ active_class((if_route('categories.show') && if_route_param('category',
    	3))) }}">问答</a>
    <a href="{{ route('categories.show', 4) }}" class="list-group-item {{ active_class((if_route('categories.show') && if_route_param('category', 4))) }}">公告</a>
</div>
