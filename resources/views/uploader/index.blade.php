@extends('layouts.app')
@section('content')
<body>
	<div class="wap-container">
		<nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
			首页
			<span class="c-gray en">/</span>
			项目资料库
			<span class="c-gray en">/</span>
			项目资料列表
			<a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>
		<article class="Hui-admin-content clearfix">
			<div class="row-24 clearfix" style="margin-left: -12px; margin-right: -12px;">
				@foreach($information as $v)
				<div class="col-24-xs-24 col-24-sm-12 col-24-md-12 col-24-lg-12 col-24-xl-6" style="padding-left: 12px; padding-right: 12px; margin-bottom: 24px;" >
					<div class="panel" >
						<div class="panel-header" style="padding:15px 24px;font-weight: 400;color:#999;">{{$v->name}}：</div>
						<div class="panel-body " style="padding:0 24px; border: 1px solid #00000" id='scrollDiv'>
							<div class=" scrollText text-c mt-10 scrollText"  style="height:170px;min-height:25px;overflow:hidden">
							<table class="table">
								<thead>
									<th>类型</th>
									<th>文件名</th>
									<th width="70">上传时间</th>
								</thead>
								<tbody>
									@foreach($v->info_loader as $k)
									<tr>
										<td> <span class="badge badge-warning radius">{{$k->filetype}}</span></td>
										<td><a href="{{$k->httpurl}}"> {{str_limit($k->name,20,'....')}}</a></td>
										<td>{{$k->created_at->format('Y.m.d')}}</td>
									</tr>
									@endforeach	
								</tbody>
							</table>
							</div>							
						
							<div class="cl text-r" style="padding: 10px 0;border-top:solid 1px #eee"><span class="c-999">总共</span><span>9个</span><span class="c-999">文件</span> <span class="btn up">&uarr; 向上</span> <span class="btn down">&darr; 向下</span></div>
						</div>
					</div>
				</div>
				@endforeach
			</div>

			
		</article>
		
	</div>
	<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="/lib/layer/3.1.1/layer.js"></script>
	<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>

	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript" src="/static/business/js/main.js"></script>
	<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="/lib/jquery.textSlider.js"></script>
	<script type="text/javascript">
	$(function(){
	$("#scrollDiv").textSlider({
		line:2, /*一次滚动条数，跟li有关*/
		speed:500, /*速度*/
		timer:3000  /*间隔时间*/
	})});

</script>
</body>
@endsection