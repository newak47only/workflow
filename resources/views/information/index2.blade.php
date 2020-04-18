@extends('layouts.app')
@section('content')
<body>
	<div class="wap-container">
		<nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
			首页
			<span class="c-gray en">/</span>
			洽谈项目管理
			<span class="c-gray en">/</span>
			洽谈项目列表
			<a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>

		<article class="Hui-admin-content clearfix">

			<div class="panel ">
				<div class="panel-body">
					<div id="tab-system" class="HuiTab">
						<div class="tabBar cl"><span>本人项目</span><span>上报项目审核<a  class=" label-danger " style=" display: block; float:right;  padding-right:5px;padding-left:5px;  border-radius:12px ; line-height: 20px;  height: 20px; color:#fff;">{{$reportnum}}</span></a><span>流转项目审核<a  class=" label-danger " style=" display: block; float:right;  padding-right:5px;padding-left:5px;  border-radius:12px ; line-height: 20px;  height: 20px; color:#fff;">{{$circulenum}}</span></a></span></div>
						<div class="tabCon">
							<div class=" mt-20 clearfix">
								<span class="f-l">
									<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
									<a href="javascript:;" onclick="information_add('添加洽谈项目','/information/create')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加洽谈项目</a>
								</span>
							</div>
							<div class="mt-20 clearfix">
								<table class="table table-border table-bordered table-bg table-hover table-sort">
									<thead>
										<tr class="text-c">
											<th width="25"><input type="checkbox" name="" value=""></th>
											<th width="40">ID</th>
											<th width="250">项目名称</th>
											<th width="80">行业类别</th>
											<th width="100">投资金额</th>
											<th width="100">资方姓名</th>
											<th width="100">资方联系方式</th>
											<th width="120">入库时间</th>
											<th width="80">工作记录</th>
											<th width=" ">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info1 as $v)
										<tr class="text-c">
											<td><input type="checkbox" value="{{$v['id']}}" name="ID"></td>
											<td>{{$v['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_edit('编辑项目','{{route('information.edit',['id'=>$v['id']])}}','{{$v['id']}}')" title="编辑项目">{{$v['name']}}</u></td>
											<td>{{$v['industry']}}</td>
											<td>{{$v['investment']}}@if($v['currency'] =="1")万人民币@elseif($v['currency'] =="2")万美元@elseif($v['currency'] =="3")万欧元@endif</td>
											<td>{{$v['cont_name']}}</td>
											<td>{{$v['cont_phone']}}</td>
											<td>{{$v['created_at']}}</td>
											<td><u style="cursor:pointer" class="text-primary" onClick="recode_show('查看工作记录','{{route('recode.show',['id'=>$v['id']])}}','{{$v['id']}}')" title="查看工作记录">{{$v['recodenum']}}条</u></td>
											<td class="td-manage">
												
												<button type="submit"  href="javascript:;" onclick="info_recode_add('进度记录','/recode/add/{{$v['id']}}')"  class=" f-l btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;进度记录&nbsp;&nbsp;&nbsp;</button>
												@if($v['is_show']==0)
												<button type="submit"  href="javascript:;" onclick="report_add('项目上报','/report/add/{{$v['id']}}')"  class=" f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe725;</i>&nbsp;&nbsp;项目上报&nbsp;&nbsp;&nbsp;</button>
												@elseif($v['is_show']==1)
												<button type="submit"  href="javascript:;" onclick="admin_role_edit('','')"  class=" f-l btn disabled radius size-S ml-10">&nbsp;<i class="Hui-iconfont">&#xe725;</i>&nbsp;上报审核中&nbsp;</button>
												@elseif($v['is_show']==2)
												<button type="submit"  href="javascript:;" onclick=""  class=" f-l btn btn-success radius size-S ml-10">&nbsp;<i class="Hui-iconfont">&#xe725;</i>&nbsp;已上报市级&nbsp;</button>
												@endif
												<button type="submit"  href="javascript:;" onclick="info_nego_add('项目落地','/negotiation/add/{{$v['id']}}')"  class=" f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;项目落地&nbsp;&nbsp;&nbsp;</button>
												@if($v['process']==1)
												<button type="submit"  href="javascript:;" onclick="admin_role_edit('','')"  class=" f-l btn disabled radius size-S ml-10">&nbsp;<i class="Hui-iconfont">&#xe6bd;</i>&nbsp;流转审核中&nbsp;</button>
												@else
												<button type="submit"  href="javascript:;" onclick="info_cir_add('项目流转','/circule/add/{{$v['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6bd;</i>&nbsp;&nbsp;项目流转&nbsp;&nbsp;&nbsp;</button></td>
												@endif
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
											<th width="120">项目联系人</th>
											<th width="120">项目联系方式</th>
											<th width="120">入库时间</th>
											<th width="120">工作记录</th>
											<th width="250">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info2 as $k)
										<tr class="text-c">
											<td><input type="checkbox" value="{{$k['id']}}" name="ID"></td>
											<td>{{$k['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_edit('查看项目','{{route('information.show',['id'=>$k['id']])}}','{{$k['id']}}')" title="查看">{{$k['name']}}</u></td>
											<td>{{$k['industry']}}</td>
											<td>{{$k['investment']}}@if($k['currency'] =="1")万人民币@elseif($k['currency'] =="2")万美元@elseif($k['currency'] =="3")万欧元@endif</td>

											<td>{{$k['staff_name']}}</td>
											<td>{{$k['staff_phone']}}</td>
											<td>{{$k['created_at']}}</td>
											<td><u style="cursor:pointer" class="text-primary" onClick="recode_show('查看工作记录','{{route('recode.show',['id'=>$k['id']])}}','{{$k['id']}}')" title="查看工作记录">{{$k['recodenum']}}条</u></td>
											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="recode_show('查看工作记录','/recode/{{$k['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe60c;</i>&nbsp;&nbsp;查看记录&nbsp;&nbsp;&nbsp;</button>
												@if($k['is_show'] == 2)
												<button type="submit"  href="javascript:;" onclick=""  class=" f-l btn btn-success radius size-S ml-10">&nbsp;<i class="Hui-iconfont">&#xe725;</i>&nbsp;已上报市级&nbsp;</button>

												@else
												<button type="submit"  href="javascript:;" onclick="info_report_edit('上报项目审核','/report/edit/{{$k['nego_id']}}')"  class=" f-l btn btn-danger radius size-S ml-10">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe725;</i>&nbsp;&nbsp;上报审核&nbsp;&nbsp;&nbsp;</button>
												@endif
												
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
											<th width="120">项目联系人</th>
											<th width="120">项目联系方式</th>
											<th width="120">入库时间</th>
											<th width="120">工作记录</th>
											<th width="250">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info3 as $m)
										<tr class="text-c">
											<td><input type="checkbox" value="{{$m['id']}}" name="ID"></td>
											<td>{{$m['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_edit('查看项目','{{route('information.show',['id'=>$m['id']])}}','{{$m['id']}}')" title="查看">{{$m['name']}}</u></td>
											<td>{{$m['industry']}}</td>
											<td>{{$m['investment']}}@if($m['currency'] =="1")万人民币@elseif($m['currency'] =="2")万美元@elseif($m['currency'] =="3")万欧元@endif</td>

											<td>{{$m['staff_name']}}</td>
											<td>{{$m['staff_phone']}}</td>
											<td>{{$m['created_at']}}</td>
											<td><u style="cursor:pointer" class="text-primary" onClick="recode_show('查看工作记录','{{route('information.show',['id'=>$m['id']])}}','{{$m['id']}}')" title="查看工作记录">{{$m['recodenum']}}条</u></td>
											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="info_recode_show('查看工作记录','/recode/show/{{$m['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe60c;</i>&nbsp;&nbsp;查看记录&nbsp;&nbsp;&nbsp;</button>
												<button type="submit"  href="javascript:;" onclick="circule_cheack('流转申请审核','/circule/check/{{$m['nego_id']}}')"  class="f-l ml-10 btn btn-danger radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6bd;</i>&nbsp;&nbsp;流转审核&nbsp;&nbsp;&nbsp;</button>												

												
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
			function information_add(title,url){
  			var index = layer.open({
    		type: 2,
    		title: title,
    		content: url,
  		});
  			layer.full(index);
		};

		function information_edit(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
			layer.full(index);
		};

										
		function info_recode_add(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
		};

		function report_add(title,url){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
		};

		function info_nego_add(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
		};

		function info_cir_add(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '700px']
			});
		};
		function info_report_edit(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
		};

		function recode_show(title,url){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
			});
			layer.full(index);
		};
		function info_recode_show(title,url){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
		};
		function circule_cheack(title,url){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
		};
  		
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>

@endsection