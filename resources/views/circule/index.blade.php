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
					<div class="mt-20 clearfix">
						<table class="table table-border table-bordered table-bg table-hover table-sort">
							<thead>
								<tr class="text-c">
									<th width="25"><input type="checkbox" name="" value=""></th>
									<th width="40">ID</th>
									<th width=" ">项目名称</th>
									<th width="80">首谈地</th>
									<th width="100">首谈地联系人</th>
									<th width="100">首谈地联系方式</th>
									<th width="80">流转方向</th>
									<th width="80">流转地</th>
									<th width="100">流转地联系人</th>
									<th width="100">流转地联系方式</th>
									<th width="120">流转时间</th>
									<th width="250">操作</th>
								</tr>
							</thead>
							<tbody>
							@foreach($info1 as $k)
								<tr class="text-c">
									<td><input type="checkbox" value="{{$k['id']}}" name="ID"></td>
									<td>{{$k['id']}}</td>
									<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','{{route('information.show',['id'=>$k['id']])}}','{{$k['id']}}')" title="查看">{{$k['name']}}</u></td>
									<td>{{$k['circule_f_dept']}}</td>
									<td>{{$k['circule_f_name']}}</td>
									<td>{{$k['circule_f_phone']}}</td>
									<td>{{$k['circule_to']}}</td>
									<td>{{$k['circule_n_dept']}}</td>
									<td>{{$k['circule_n_name']}}</td>
									<td>{{$k['circule_n_phone']}}</td>
									<td>{{$k['created_at']}}</td>
									<td class="td-manage">

									<button type="submit"  href="javascript:;" onclick="information_edit('查看流转详情','/recode/{{$k['id']}}')"  class="btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;查看流转记录&nbsp;&nbsp;&nbsp;</button>
	
									</td>
								</tr>
							@endforeach
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
		}

		function information_edit(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
			layer.full(index);
		}

										
		function negotiation_create(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px']
			});
	}
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
