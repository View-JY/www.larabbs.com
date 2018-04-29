<div class="list-group">
    <a href="{{ route('topics.index') }}" class="list-group-item {{ active_class(if_route('topics.index')) }}">
      话题<span class="glyphicon glyphicon-chevron-right pull-right"></span>
    </a>
    <a href="{{ route('categories.show', 1) }}" class="list-group-item {{ active_class((if_route('categories.show') && if_route_param('category', 1))) }}">分享<span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
    <a href="{{ route('categories.show', 2) }}" class="list-group-item {{ active_class((if_route('categories.show') && if_route_param('category', 2))) }}">教程<span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
    <a href="{{ route('categories.show', 3) }}" class="list-group-item {{ active_class((if_route('categories.show') && if_route_param('category',
    	3))) }}">问答<span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
    <a href="{{ route('categories.show', 4) }}" class="list-group-item {{ active_class((if_route('categories.show') && if_route_param('category', 4))) }}">公告<span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
</div>


<div class="panel panel-default">
    <div class="panel-body">
        <a href="{{ route('topics.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 新建帖子
        </a>
    </div>
</div>