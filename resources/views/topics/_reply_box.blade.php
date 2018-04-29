@include('common.errors')
<div class="reply-box">
    <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="写下你的想法" name="content" style="resize: none;"></textarea>
        </div>
        <button type="submit" class="btn btn-success"><i class="fa fa-share"></i>回复</button>
    </form>
</div>
<hr>