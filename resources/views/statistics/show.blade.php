@extends('layouts.app')
@section('content')
<body>
	<div class="wap-container">
		

		<article class="Hui-admin-content clearfix">

			<div class="panel ">
				<div class="panel-body">
					
					<div class=" clearfix text-c"><h3>{{$information->name}}</h3><br/><h4>实际到位资金</h4>
						<table class="table table-border table-bordered table-bg table-hover table-sort">
							<thead>
								<tr class="text-c">
									@foreach($fund as $v)
									<th width="">{{$v['year']}}年度</th>
									@endforeach
								</tr>
							</thead>
							<tbody>
								<tr class="text-c">
									@foreach($fund as $v)
									<th width=""><a href="/statistics/edit/{{$v['id']}}" > {{$v['data']}}</a>
										@if($v['currency'] =='0')万人民币
										@elseif($v['currency'] =='1')万美元
										@elseif($v['currency'] =='2')万欧元
										@endif
									</th>
									@endforeach
								</tr>
							</tbody>
						</table>
					</div>
					<div class=" clearfix text-c"><h4>GDP</h4>
						<table class="table table-border table-bordered table-bg table-hover table-sort">
							<thead>
								<tr class="text-c">
									@foreach($gdp as $v)
									<th width="">{{$v['year']}}年度</th>
									@endforeach
								</tr>
							</thead>
							<tbody>
								<tr class="text-c">
									@foreach($gdp as $v)
									<th width=""><a href="/statistics/edit/{{$v['id']}}" > {{$v['data']}}</a>
										@if($v['currency'] =='0')万人民币
										@elseif($v['currency'] =='1')万美元
										@elseif($v['currency'] =='2')万欧元
										@endif
									</th>
									@endforeach
								</tr>
							</tbody>
						</table>
					</div>
					<div class=" clearfix text-c"><h4>土地指标</h4>
						<table class="table table-border table-bordered table-bg table-hover table-sort">
							<thead>
								<tr class="text-c">
									@foreach($land as $v)
									<th width="">{{$v['year']}}年度</th>
									@endforeach
								</tr>
							</thead>
							<tbody>
								<tr class="text-c">
									@foreach($land as $v)
									<th width=""><a href="/statistics/edit/{{$v['id']}}" > {{$v['data']}}</a>
										@if($v['currency'] =='0')万人民币
										@elseif($v['currency'] =='1')万美元
										@elseif($v['currency'] =='2')万欧元
										@endif
									</th>
									@endforeach
								</tr>
							</tbody>
						</table>
					</div>
					<div class=" clearfix text-c"><h4>留存部分税收</h4>
						<table class="table table-border table-bordered table-bg table-hover table-sort">
							<thead>
								<tr class="text-c">
									@foreach($tax as $v)
									<th width="">{{$v['year']}}年度</th>
									@endforeach
								</tr>
							</thead>
							<tbody>
								<tr class="text-c">
									@foreach($tax as $v)
									<th width=""><a href="/statistics/edit/{{$v['id']}}" > {{$v['data']}}</a>
										@if($v['currency'] =='0')万人民币
										@elseif($v['currency'] =='1')万美元
										@elseif($v['currency'] =='2')万欧元
										@endif
									</th>
									@endforeach
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</article>
	</div>

	<!--_footer 作为公共模版分离出去-->
	<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="/lib/layer/3.1.1/layer.js"></script>
	<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
	<!--/_footer /作为公共模版分离出去-->

	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript" src="/lib/datatables/1.10.15/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>
	<script type="text/javascript" src="/static/business/js/main.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>


	<script type="text/javascript">
	$(function(){
			runDatetimePicker();
      // 全选 页面调用
  
			function information_add(title,url){
  			var index = layer.open({
    		type: 2,
    		title: title,
    		content: url,
  		});
  			layer.full(index);
		}

		function information_edit(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
			layer.full(index);
		}

										
		function negotiation_create(title,url){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
	}
  		
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection
