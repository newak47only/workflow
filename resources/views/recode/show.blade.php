@extends('layouts.app')
@section('content')
<body>
	<div class="wap-container">

		<article class="Hui-admin-content clearfix">
			<div class="panel ">
				<div class="panel-body">
					<div id="tab-system" class="HuiTab">
						<div class="tabBar cl"><span>工作记录</span><span>流转记录</span></div>
							<div class="tabCon">
								<div class="mt-20 clearfix">
									<table class="table  table-hover">
										<thead>
											<tr class="text-c">
												<th width="120">记录时间</th>
												<th width="80">记录人</th>
												<th width="80">方式</th>
												<th width="80">洽谈对象</th>
												<th width="250">项目名称</th>
												<th width="500">洽谈事项</th>
											</tr>
										</thead>
										<tbody>
											@foreach($recode as $k)
											<tr class="text-c">	
												<td>{{$k->created_at->format('Y年m月d日 h:m:s')}}</td>
												<td>{{$k->emp->username}}</td>
												<td>{{$k->mode}}</td>
												<td>{{$k->elephant}}</td>
												<td>{{$k->info->name}}</td>
												<td><u style="cursor:pointer" class="text-primary" onClick="recode_content('查看洽谈内容','{{$k->content}}')" title="查看洽谈内容">{{str_limit($k->content,100,'....')}}</u></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<div class="tabCon">
								<div class="mt-20 clearfix">
									<table class="table  table-hover">
										<thead>
											<tr class="text-c">
												<th width="120">操作时间</th>
												<th width="200">项目名称</th>
												<th width="80">操作人</th>
												<th width="80">操作名称</th>
												<th width="80">操作说明</th>
												<th width="80">操作时间</th>
												<th width="80">操作人</th>
												<th width="80">操作名称</th>
												<th width="80">操作说明</th>
												<th width="80">操作结果</th>
											</tr>
										</thead>
										<tbody>
											@foreach($nego as $m)
											<tr class="text-c">
												<td>{{$m->created_at->format('Y年m月d日 h:m:s')}}</td>
												<td>{{$m->nego_info->name}}</td>
												<td>{{$m->emp->username}}</td>
												<td>{{$m->eaction}}</td>
												<td><a><u style="cursor:pointer" class="text-primary" onClick="recode_content('查看操作说明','{{$m->remark}}')" title="查看操作说明">{{str_limit($m->remark,20,'....')}}</u></a></td>
												<td>{{$m->neg_at}}</td>
												@if(empty($m->demp->username))
												<td></td>
												@else
												<td>{{$m->demp->username}}</td>
												@endif
												<td>{{$m->daction}}</td>
												<td><a><u style="cursor:pointer" class="text-primary" onClick="recode_content('查看操作说明','{{$m->report}}')" title="查看操作说明">{{str_limit($m->report,20,'....')}}</u></a></td>
												@if($m->result == 1)
												<td> <span class="badge badge-success radius">审核通过</span></td>
												@elseif($m->result == 3)
												<td> <span class="badge badge-danger radius">流转失败</span></td>
												@elseif($m->result ==4)
												<td> <span class="badge badge-success radius">流转成功</span></td>
												@elseif($m->result ==0)
												<td> <span class="badge badge-secondary radius">等待审核</span></td>
												@elseif($m->result ==2)
												<td> <span class="badge badge-danger radius">审核未通过</span></td>
												@endif
												
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
			"bLengthChange":false,

		});

										
		function recode_content(title,content){
			var index = layer.open({
			type: 1,
			title: title,
			skin: 'layui-layer-rim',
			content: content,
    		area: ['450px', '450px']
			});
		};

  		
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>

@endsection