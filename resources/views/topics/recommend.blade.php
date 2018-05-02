{{-- 文章推荐 --}}
<div class="">
    <div class="col-lg-12 col-md-12 hidden-sm hidden-xs author-info" style="background: #fff; padding-top: 50px; border-top: 2px solid #00b5ad;">
        <div class="recommend" style="width: 100%; margin: 0 auto;">
            <div class="title" style="padding-left: 8px; border-left: 3px solid #00b5ad !important; line-height: 1; font-size: 15px;">
            推荐阅读
            <a target="_blank" href="/" class="more" style="float: right; font-size: 14px; color: #A0A0A0;">
               更多精彩内容<i class="iconfont ic-link"></i>
            </a>
            </div>
        </div>
        
        @foreach($recommend as $rec)
        <div class="rec-list" style="width: 100%; margin: 0 aut0; margin-top: 20px;">
            <div class="note have-img" style="display: block; margin-bottom: 25px; padding: 0 0 25px 0;  border-bottom: 1px solid #DDDDDD; position: relative; min-height: 100px;">
                <a href="{{ route('topics.show', $rec ->id) }}" style="float: right; margin: -5px 0 0 15px; width: 150px; height: 150px; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 6px;">
                   @if($rec -> user ->showImg)
                   <img src="{{ $rec ->showImg }}" style="display: block; width: 150px; height: 150px;">
                   @endif
                </a>
                <a target="_blank" href="{{ route('topics.show', $rec ->id) }}" class="title" style="display: inherit; margin-bottom: 4px; font-size: 18px; line-height: 27px; font-weight: bold;color: #333333; overflow: hidden; -o-text-overflow: ellipsis;text-overflow: ellipsis;white-space: nowrap; color: #999;">{{ $rec ->title }}</a>
                <p class="description" style="margin-bottom: 12px; font-size: 13px;line-height: 23px; color: #333333; overflow: hidden; -o-text-overflow: ellipsis;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $rec ->excerpt }}</p>
                <a target="{{ route('users.show', $rec ->user) }}" href="#" class="author">
                    <div class="avatar"style="display: inline-block; width: 24px; height: 24px; margin-right: 3px; border-radius: 50%; background-position: center; background-repeat: no-repeat;background-size: cover; vertical-align: middle;">
                         @if($rec -> user->avatar)
                        <img src="{{ $rec -> user->avatar }}" style="display: block; width: 24px; height: 24px;">
                        @endif
                    </div> 
                    <span class="name" style="display: inline-block; vertical-align: middle; font-size: 13px;">{{ $rec ->user ->name }}</span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>