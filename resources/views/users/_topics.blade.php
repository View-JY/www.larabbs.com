@if (count($topics))

<ul class="list-group">
    @foreach ($topics as $topic)
        <li class="list-group-item">
            <a href="{{ route('topics.show', $topic->id) }}"style="color: #00b5ad !important">
                {{ $topic->title }}
            </a>
            <span class="meta pull-right">
                {{ $topic->reply_count }} 回复
                <span> ⋅ </span>
                {{ $topic->created_at->diffForHumans() }}
            </span>
        </li>
    @endforeach
</ul>

@else
<div class="empty-block">
    @include('layouts._empty')
</div>
@endif

{{-- 分页 --}}
{!! $topics->render() !!}
