@extends('layouts.app')
@section('content')
	<div class="wap-container">
		<nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
			首页
			<span class="c-gray en">/</span>
			管理员管理
			<span class="c-gray en">/</span>
			权限管理
			<a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>

		<article class="Hui-admin-content clearfix">

			<div class="panel mt-20">
				<div class="panel-body">
					<div class="clearfix">
						<span class="f-l">
							<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
							<a href="javascript:;" onclick="admin_permission_add('添加权限节点','/permission/create')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限节点</a>
						</span>
					</div>
					<div class="mt-20 clearfix">
						<table class="table table-border table-bordered table-bg table-hover table-sort">
							<thead>

								<tr class="text-c">
									<th width="25"><input type="checkbox" name=" " value=""></th>
									<th width="40">ID</th>
									<th width="200">权限名称</th>
									<th width="">控制器名</th>
									<th width="">方法名</th>
									<th width="">父级权限</th>
									<th width="">是否导航</th>
									<th width="100">操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $val)
								<tr class="text-c">
									<td><input type="checkbox" value="{{$val->id}}" name="box"></td>
									<td>{{$val->id}}</td>
									<td>{{$val->permissionname}}</td>
									<td>{{$val->controller}}</td>
									<td>{{$val->action}}</td>
									<td>@if($val->pid){{$val->perant_name}} @else 顶级权限 @endif</td>

									<td>@if($val->is_nav == 1) 是 @else 否 @endif</td>
									<td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('权限编辑','permission/{{$val->id}}/edit')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="permission_del(this,'{{$val->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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

		function admin_permission_add(title,url){
  			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '450px']
			});
		}

		function admin_permission_edit(title,url){
  			var index = layer.open({
			type: 2,
			title: title,
			content: url,
    		area: ['800px', '450px']
			});
		}

		function permission_del(obj,id){
  			layer.confirm('确认要删除权限吗？',{title:'删除权限'},function(index){
                $.ajax({
					type: 'GET',
					url: '/permission/destroy/'+id,
			
					success: function(data){
						$(obj).parents("tr").remove();
						layer.msg('权限已删除!',{icon:1,time:2000});
					},
					error:function(data) {
						console.log(data.msg);
					},
				});
  			});
		}

		function datadel(){

			  				//获取到所有的input
           		var  box = $("input[name='box']");
           		//去所有的input长度
           		length =box.length;
           		//alert(length);
           		var str ="";
           		for(var i=0;i<length;i++){
               		//如果数组中的checked 为true  就将他的id进行拼接
               		if(box[i].checked==true){
                   		str =str+","+box[i].value;
               		}
           		}
           		//将拼接的字符串第一个，号删除
           		str= str.substr(1);
  			layer.confirm('确认要批量删除权限吗？',{title:'批量删除权限'},function(index){
                $.ajax({
					type: 'GET',
					url: '/permission/aajax/'+str,
					success: function(data){
						layer.msg('权限已删除!',{icon:1,time:2000});
						var index = layer.getFrameIndex(window.name);							
								location.replace(location.href);
								layer.close(index);
					},
					error:function(data) {
						layer.msg('权限删除错误!',{icon:2,time:2000});
						var index = layer.getFrameIndex(window.name);
								location.replace(location.href);
								//parent.$('.btn-refresh').click();
								layer.close(index);
					},
				});
  			});
		}		

	</script>
@endsection
