<?php
   
?>
<div class="bdsharebuttonbox pull-right" data-tag="share_1" style="margin-top: 50px;">
    <a class="bds_mshare" data-cmd="mshare"></a>
    <a class="bds_qzone" data-cmd="qzone" href="#"></a>
    <a class="bds_tsina" data-cmd="tsina"></a>
    <a class="bds_baidu" data-cmd="baidu"></a>
    <a class="bds_renren" data-cmd="renren"></a>
    <a class="bds_tqq" data-cmd="tqq"></a>
    <a class="bds_more" data-cmd="more">更多</a>
    <a class="bds_count" data-cmd="count"></a>
</div>

@section('script')
<script>
    window._bd_share_config = {
		common : {
                    bdText : '{{$bdText}}',	
                    bdDesc : '{{$bdDesc}}',	
                    bdUrl : '{{$bdUrl}}', 	
                    bdPic : '{{$bdPic}}'
		},
		share : [{
			"bdSize" : 16
		}],
		selectShare : [{
                    "bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
		}]
	}

    //以下为js加载部分
    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
@endsection