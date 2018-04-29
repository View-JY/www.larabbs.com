@if (count($topics))

    <ul class="media-list">
        @foreach ($topics as $topic)
            <li class="meta" style="position: relative; min-height: 150px; padding: 15px 2px 15px 0; border-bottom: 1px solid #f0f0f0; word-wrap: break-word;">
                @if(isset($topic ->showimg))
                <a href="{{ route('users.show', [$topic ->user_id]) }}" class="" style="display: block; width: 120px; height: 120px; position: absolute; top: 50%; margin-top: -60px; right: 5px;">
                    <img src="{{ $topic->showimg }}" title="{{ $topic->showimg }}" style="display: block; width: 100%; height: 100%; border-radius: 4px; border: 1px solid #f0f0f0;">
                </a>
                @endif
                <div class="meta-content" style="padding-right: 160px;">
                    <div class="auth" style="margin-bottom: 15px; font-size: 12px;">
                        <a class="avatar" target="_blank" href="{{ route('users.show', [$topic ->user_id]) }}">
                            <img src="{{ $topic->user->avatar }}" alt="64" style="display: inline-block; width: 32px; height: 32px; margin-right: 5px; border-radius: 50%;" data-toggle="tooltip" data-placement="left" title="{{ $topic->user->introduction }}">
                        </a>
                        <div class="info" style="display: inline-block; vertical-align: middle;">
                            <a class="nickname" target="_blank" href="{{ route('users.show', [$topic->user_id]) }}" style="vertical-align: middle; margin-right: 5px;">{{ $topic->user->name }}</a>
                            <span class="time">{{ $topic ->created_at }}</span>
                        </div>
                    </div>

                    <a class="title" target="_blank" href="{{ route('topics.show', [$topic->id]) }}" title="{{ $topic->user->name }}" style="font-size: 18px; line-height: 1.5; font-weight: 700; color: #333;">{{ $topic ->title }}</a>

                    <p class="abstract" style="font-size: 12px; line-height: 24px; margin: 0 0 8px;">
                        {{ $topic ->excerpt }}
                    </p>

                    <div class="" style="font-size: 12px; line-height: 20px;">
                        <a href="{{ route('categories.show', $topic->category->id) }}" title="{{ $topic->category->name }}" style="margin-right: 5px; line-height: 20px;">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                             {{ $topic->category->name }}
                        </a>
                        <a href="{{ route('topics.show', [$topic->id]) }}" title="评论数" style="margin-right: 5px; line-height: 20px;">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            {{ $topic->reply_count }}
                        </a>
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        <span class="timeago" title="最后活跃于" style="margin-right: 5px; line-height: 20px;">{{ $topic->updated_at->diffForHumans() }}</span>     
                    </div>
                </div>
            </li>

        @endforeach
    </ul>

@else
   <div class="empty-block">暂无数据 ~_~ </div>
@endif

@section('script')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection