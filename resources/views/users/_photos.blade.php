@if (count($photos))

<ul class="list-group">
    @foreach ($photos as $photo)
        <li class="list-group-item">
            <a href="{{ route('photos.show', $photo->id) }}"style="color: #00b5ad !important">
                {{ $photo->type }}
            </a>
            <span class="meta pull-right">
                {{ $photo->created_at->diffForHumans() }}
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
{!! $photos->render() !!}
