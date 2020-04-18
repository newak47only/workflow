@extends('layouts.app')

@section('content')
<body>
	<div class="wap-container">
		<nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
			首页
			<span class="c-gray en">/</span>
			管理员管理
			<span class="c-gray en">/</span>
			部门管理
			<a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>
		<article class="Hui-admin-content clearfix">
			<div class="panel">
				<div class="panel-body">
					<div class="clearfix">
						<span class="f-l">
							
							<a class="btn btn-primary radius" href="javascript:;" onclick="dept_create('添加部门','/dept/create')"><i class="Hui-iconfont">&#xe600;</i> 添加部门</a>
						</span>
					</div>
					<div class="mt-20 clearfix">
						<table class="table table-border table-bordered table-hover table-bg">
							<thead>
								<tr class="text-c">
									<th width="25"><input type="checkbox" value="" name=""></th>
									<th width="40">ID</th>
									<th width="200">部门名</th>
									<th>部门主管</th>
                    				<th>部门副主管</th>
									<th>部门权限</th>
									<th>部门操作</th>
                    				<th>操作</th>
								</tr>
							</thead>
							<tbody>
								 @foreach($depts as $v)
								<tr class="text-c">
									<td><input type="checkbox" value="{{$v->id}}" name="box"></td>
									<td>{{$v->id}}</td>
									<td>{{$v->html}}{{$v->dept_name}}</td>
									<td>
										@if($v->director)
                      						{{$v->director->name}}
                      					@else
                      						--
                      					@endif
                      				</td>
									<td>
										@if($v->manager)
                      						{{$v->manager->name}}
                      					@else
                      						--
                      					@endif
                      				</td>
									<td scope="row">{{$v->permission_ids}}</td>
									<td scope="row">{{$v->permission_ac}}</td>
									<td class="f-14"><a title="编辑"  href="javascript:;"  onclick="dept_edit('部门编辑','/dept/{{$v->id}}/edit','{{$v->id}}')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="dept_del(this,'{{$v->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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
	<!--/请在上方写此页面业务相关的脚本-->
  <script type="text/javascript">
		$(function(){
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

		function dept_create(title,url){
  			var index = layer.open({
				type: 2,
				title: title,
				content: url,
    		area: ['800px', '600px'],
			});
		}

		function dept_edit(title,url,id){
  			
  			var index = layer.open({
    		type: 2,
			title: title,
			content: url,
    		area: ['800px', '600px'],
  			});
		}

		function dept_del(obj,id){
  			layer.confirm('确认要删除部门吗？',{title:'删除部门'},function(index){
                $.ajax({
					type: 'GET',
					url: '/dept/destroy/'+id,

					success: function(data){
						if(data == '2'){
							layer.msg('该部门有子部门无法删除!',{icon:1,time:2000});
						}
						if(data == '3'){
							layer.msg('该部门有用户无法删除!',{icon:1,time:2000});
						}
						if(data == '1'){
							$(obj).parents("tr").remove();
							layer.msg('部门已删除!',{icon:1,time:2000});
						}
						if(data == '0'){

							layer.msg('部门删除错误',{icon:1,time:2000});
						}
						
					},
					error:function(data) {
						console.log(data.msg);
					},
				});
  			});
		}

		
	</script>
</body>
@endsection
