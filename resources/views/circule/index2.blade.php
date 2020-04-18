@extends('layouts.app')
@section('content')
<body>
	<div class="wap-container">
		<nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
			首页
			<span class="c-gray en">/</span>
			项目绩效管理
			<span class="c-gray en">/</span>
			项目绩效列表
			<a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>

		<article class="Hui-admin-content clearfix">

			<div class="panel ">
				<div class="panel-body">
					<div id="tab-system" class="HuiTab">
						<div class="tabBar cl"><span>我可以流转的项目</span><span>我发布的流转的项目</span><span>我在流转的项目</span></div>
						<div class="tabCon">
							<div class="mt-20 clearfix">
								<table class="table table-border table-bordered table-bg table-hover table-sort">
									<thead>
										<tr class="text-c">
											<th width="25"><input type="checkbox" name="" value=""></th>
											<th width="40">ID</th>
											<th width="">项目名称</th>
											<th width="100">行业类别</th>
											<th width="120">投资金额</th>
											<th width="100">首谈地</th>
											<th width="100">首谈地联系人</th>
											<th width="100">首谈地联系方式</th>
											<th width="80">流转方向</th>
											<th width="120">流转时间</th>
											<th width="250">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info1 as $val)
										<tr class="text-c">
											<td><input type="checkbox" value="{{$val['id']}}" name="ID"></td>
											<td>{{$val['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','{{route('information.show',['id'=>$val['id']])}}','{{$val['id']}}')" title="查看">{{$val['name']}}</u></td>
											<td>{{$val['industry']}}</td>
											<td>{{$val['investment']}}@if($val['currency'] =="1")万人民币@elseif($val['currency'] =="2")万美元@elseif($val['currency'] =="3")万欧元@endif</td>
											<td>{{$val['circule_f_dept']}}</td>
											<td>{{$val['staff_name']}}</td>
											<td>{{$val['staff_phone']}}</td>
											<td>{{$val['circule_to']}}</td>
											<td>{{$val['updated_at']}}</td>

											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="cricule_view('查看流转详情','/recode/{{$val['id']}}')"  class="btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;查看流转记录&nbsp;&nbsp;&nbsp;</button>	
												<button type="submit"  href="javascript:;" onclick="negotiation_create('申请流转','/circule/start_circule/{{$val['nego_id']}}')"  class="btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;申请流转&nbsp;&nbsp;</button>										
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="tabCon">
							<div class="mt-20 clearfix">
								<table class="table table-border table-bordered table-bg table-hover table-sort">
									<thead>
										<tr class="text-c">
											<th width="25"><input type="checkbox" name="" value=""></th>
											<th width="40">ID</th>
											<th width="">项目名称</th>
											<th width="100">行业类别</th>
											<th width="120">投资金额</th>
											<th width="100">项目负责人</th>
											<th width="100">联系方式</th>
											<th width="80">流转方向</th>
											<th width="120">流转状态</th>
											<th width="120">流转时间</th>
											<th width="250">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info as $v)
										<tr class="text-c">
											<td><input type="checkbox" value="{{$v['id']}}" name="ID"></td>
											<td>{{$v['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','{{route('information.show',['id'=>$v['id']])}}','{{$v['id']}}')" title="查看">{{$v['name']}}</u></td>
											<td>{{$v['industry']}}</td>
											<td>{{$v['investment']}}@if($v['currency'] =="1")万人民币@elseif($v['currency'] =="2")万美元@elseif($v['currency'] =="3")万欧元@endif</td>
											<td>{{$v['staff_name']}}</td>
											<td>{{$v['staff_phone']}}</td>
											<td>{{$v['circule_to']}}</td>
											<td>@if($v['result'] == 0)暂无流转@elseif($v['result'] == 1){{$v['circule_n_dept']}}流转中@endif</td>
											<td>{{$v['updated_at']}}</td>
											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="cricule_view('查看流转详情','/recode/{{$v['id']}}')"  class="btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;查看流转记录&nbsp;&nbsp;&nbsp;</button>	
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="tabCon">
							<div class="mt-20 clearfix">
								<table class="table table-border table-bordered table-bg table-hover table-sort">
									<thead>
										<tr class="text-c">
											<th width="25"><input type="checkbox" name="" value=""></th>
											<th width="40">ID</th>
											<th width="250">项目名称</th>
											<th width="100">首谈地</th>
											<th width="100">首谈地联系人</th>
											<th width="100">首谈地联系方式</th>
											<th width="100">流转方向</th>
											<th width="80">流转地</th>

											<th width="130">流转时间</th>
											<th width="80">工作记录</th>
											<th width="100">剩余天数</th>
											<th width="250 ">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info2 as $k)
										@if($k['day'] > 4)
										<tr class="text-c">
										@elseif($k['day'] > 2 && $k['day'] <= 4 )
										<tr  class="warning text-c">
										@elseif($k['day'] <= 2)
										<tr class="danger text-c">
										@endif
											<td><input type="checkbox" value="{{$k['id']}}" name="ID"></td>
											<td>{{$k['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','{{route('information.show',['id'=>$k['id']])}}','{{$k['id']}}')" title="查看">{{$k['name']}}</u></td>
											<td>{{$k['circule_f_dept']}}</td>
											<td>{{$k['circule_f_name']}}</td>
											<td>{{$k['circule_f_phone']}}</td>
											<td>{{$k['circule_to']}}</td>
											<td>{{$k['circule_n_dept']}}</td>
											<td>{{$k['created_at']}}</td>
											<td><u style="cursor:pointer" class="text-primary" onClick="cricule_view('查看工作记录','{{route('recode.show',['id'=>$k['id']])}}','{{$k['id']}}')" title="查看工作记录">{{$k['recodenum']}}条</u></td>
											@if($k['day'] > 4)
											<td ><span class="badge badge-success radius">洽谈剩余{{$k['day']}}天</span></td>
											@elseif($k['day'] > 2 && $k['day'] <= 4 )
											<td  class="warning"><span class="label label-warning radius">洽谈剩余{{$k['day']}}天</span></td>
											@elseif($k['day'] <= 2)
											<td  class="danger"><span class="label badge-danger radius">洽谈剩余{{$k['day']}}天</span></td>
											@endif

											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="information_show('进度记录','/recode/ciradd/{{$k['nego_id']}}')"  class="btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;进度记录&nbsp;&nbsp;&nbsp;</button>
												<button type="submit"  href="javascript:;" onclick="information_show('流转结果','/circule/redit/{{$k['nego_id']}}')"  class="btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;流转结果&nbsp;&nbsp;</button>
												
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							
						</div>
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
      $(".table").HuicheckAll(
        {
          checkboxAll: 'thead input[type="checkbox"]',
          checkbox: 'tbody input[type="checkbox"]'
        },
        function(checkedInfo) {
          console.log(checkedInfo);
        }
      )
		});
		$("#tab-system").Huitab();

		$('table').dataTable({
			//禁掉第一列排序
			"aoColumnDefs":[{"bSortable":false,"aTargets":[0]}],
			//默认在初始化的时候按照指定列排序
			"aaSorting":[[1,"asc"]],
			//禁用搜索
			"searching":false,
		});


		function negotiation_create(title,url,id){

			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
	}
										
		function cricule_view(title,url){
  			var index = layer.open({
    		type: 2,
    		title: title,
    		content: url,
  		});
  			layer.full(index);
		};


	function information_show(title,url,id){
  		var index = layer.open({
		type: 2,
		title: title,
		content: url,
    	area: ['800px', '600px'],
  		});
	}
  		
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection
