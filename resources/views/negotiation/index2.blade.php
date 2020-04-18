@extends('layouts.app')
@section('content')
<body>
	<div class="wap-container">
		<nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
			首页
			<span class="c-gray en">/</span>
			落地项目管理
			<span class="c-gray en">/</span>
			落地项目列表
			<a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>

		<article class="Hui-admin-content clearfix">
			<div class="panel ">
				<div class="panel-body">
					<div id="tab-system" class="HuiTab">
						<div class="tabBar cl"><span>全程项目</span><span>流转项目</span><span>首谈地项目</span></div>
						<div class="tabCon">
							<div class="mt-20 clearfix">
								<table class="table table-border table-bordered table-bg table-hover table-sort">
									<thead>
										<tr class="text-c">
											<th width="40">ID</th>
											<th width="">项目名称</th>
											<th width="100">行业类别</th>
											<th width="100">投资金额</th>
											<th width="100">项目进度</th>
											<th width="150">项目落户地</th>
											<th width="100">工作记录</th>
											<th width="450">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info as $v)
										<tr class="text-c">
											<td>{{$v['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','{{route('information.show',['id'=>$v['id']])}}','{{$v['id']}}')" title="查看">{{$v['name']}}</u></td>
											<td>{{$v['industry']}}</td>
											<td>{{$v['investment']}}@if($v['currency'] =='0')万人民币
										@elseif($v['currency'] =='1')万美元
										@elseif($v['currency'] =='2')万欧元
										@endif</td>
											<td>@if($v['process'] == '4')
												已签约
												@elseif($v['process'] == '5')
												已开工
												@elseif($v['process'] == '6')
												已投产
												@endif
											</td>
											<td>{{$v['dept']}}</td>
											<td><u style="cursor:pointer" class="text-primary" onClick="information_add('查看工作记录','{{route('recode.show',['id'=>$v['id']])}}','{{$v['id']}}')" title="查看工作记录">{{$v['recodenum']}}条</u></td>
											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="negotiation_create('进度记录','/recode/add/{{$v['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;进程记录&nbsp;&nbsp;&nbsp;</button>
												@if($v['process']==4)
												<button type="submit"  href="javascript:;" onclick="negotiation_create('项目开工','/landing/add/{{$v['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;项目开工&nbsp;&nbsp;</button>
												@elseif($v['process']==5)
												<button type="submit"  href="javascript:;" onclick="negotiation_create('项目投产','/completion/add/{{$v['id']}}')"  class=" f-l ml-10 btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;项目投产&nbsp;&nbsp;</button>
												@elseif($v['process']==6)
												<button type="submit"  href="javascript:;" onclick="')"  class=" f-l ml-10 btn btn-success radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;&nbsp;&nbsp;已投产&nbsp;&nbsp;</button>
												@endif
												<button type="submit"  href="javascript:;" onclick="negotiation_create('添加数据','/statistics/add/{{$v['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;添加数据&nbsp;&nbsp;&nbsp;</button>
												
												<button type="submit"  href="javascript:;" onclick="negotiation_create('查看数据','/statistics/{{$v['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;查看数据&nbsp;&nbsp;</button>											
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
											<th width="40">ID</th>
											<th width="">项目名称</th>
											<th width="100">投资金额</th>
											<th width="80">项目进度</th>
											<th width="100">项目落户地</th>
											<th width="100">首谈地</th>
											<th width="100">首谈地联系人</th>
											<th width="100">首谈地联系方式</th>
											<th width="100">工作记录</th>
											<th width="450 ">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info1 as $k)
										<tr class="text-c">
											<td>{{$k['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','{{route('information.show',['id'=>$k['id']])}}','{{$k['id']}}')" title="查看">{{$k['name']}}</u></td>
											<td>{{$k['investment']}}@if($k['currency'] =='0')万人民币
										@elseif($k['currency'] =='1')万美元
										@elseif($k['currency'] =='2')万欧元
										@endif</td>
											<td>@if($k['process'] == '4')
												已签约
												@elseif($k['process'] == '5')
												已开工
												@elseif($k['process'] == '6')
												已投产
												@endif
											</td>
											<td>{{$k['circule_n_dept']}}</td>
											<td>{{$k['circule_f_dept']}}</td>
											<td>{{$k['circule_f_name']}}</td>
											<td>{{$k['circule_f_phone']}}</td>
											<td><u style="cursor:pointer" class="text-primary" onClick="information_add('查看工作记录','{{route('recode.show',['id'=>$k['id']])}}','{{$k['id']}}')" title="查看工作记录">{{$k['recodenum']}}条</u></td>
											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="negotiation_create('进度记录','/recode/add/{{$k['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;进程记录&nbsp;&nbsp;&nbsp;</button>
												@if($k['process']==4)
												<button type="submit"  href="javascript:;" onclick="negotiation_create('项目开工','/landing/add/{{$k['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;项目开工&nbsp;&nbsp;</button>
												@elseif($k['process']==5)
												<button type="submit"  href="javascript:;" onclick="negotiation_create('项目投产','/completion/add/{{$k['id']}}')"  class=" f-l ml-10 btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;项目投产&nbsp;&nbsp;</button>
												@elseif($k['process']==6)
												<button type="submit"  href="javascript:;" onclick=""  class=" f-l ml-10 btn btn-success radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;&nbsp;&nbsp;已投产&nbsp;&nbsp;</button>
												@endif
												<button type="submit"  href="javascript:;" onclick="negotiation_create('添加数据','/statistics/add/{{$k['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;添加数据&nbsp;&nbsp;&nbsp;</button>
												
												<button type="submit"  href="javascript:;" onclick="negotiation_create('查看数据','/statistics/{{$k['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;查看数据&nbsp;&nbsp;</button>											
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
											<th width="40">ID</th>
											<th width="">项目名称</th>
											<th width="">行业类别</th>
											<th width="100">投资金额</th>
											<th width="100">项目进度</th>
											<th width="150">项目首谈地</th>
											<th width="100">项目落户地</th>
											<th width="100">落户地联系人</th>
											<th width="100">落户地联系方式</th>
											<th width="100">工作记录</th>
											<th width="150">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info2 as $kk)
										<tr class="text-c">
											<td>{{$kk['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','{{route('information.show',['id'=>$kk['id']])}}','{{$kk['id']}}')" title="查看">{{$kk['name']}}</u></td>
											<td>{{$kk['industry']}}</td>
											<td>{{$kk['investment']}}@if($kk['currency'] =='0')万人民币
										@elseif($kk['currency'] =='1')万美元
										@elseif($kk['currency'] =='2')万欧元
										@endif</td>
											<td>@if($kk['process'] == '2')
												已签约
												@elseif($kk['process'] == '3')
												已开工
												@elseif($kk['process'] == '4')
												已投产
												@endif
											</td>
											<td>{{$kk['circule_f_dept']}}</td>
											<td>{{$kk['circule_n_dept']}}</td>
											<td>{{$kk['circule_n_name']}}</td>
											<td>{{$kk['circule_n_phone']}}</td>
											<td><u style="cursor:pointer" class="text-primary" onClick="information_add('查看工作记录','{{route('recode.show',['id'=>$kk['id']])}}','{{$kk['id']}}')" title="查看工作记录">{{$kk['recodenum']}}条</u></td>
											<td class="td-manage">												
												<button type="submit"  href="javascript:;" onclick="negotiation_create('查看数据','/statistics/{{$kk['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;查看数据&nbsp;&nbsp;</button>											
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

		function information_show(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
		};

										
		function negotiation_create(title,url){
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
