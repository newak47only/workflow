@extends('layouts.app')
@section('content')
<body>
	<div class="wap-container">
		<nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
			首页
			<span class="c-gray en">/</span>
			管理员管理
			<span class="c-gray en">/</span>
			管理员列表
			<a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>

		<article class="Hui-admin-content clearfix">

			<div class="panel ">
				<div class="panel-body">
					<div class="clearfix">
						<span class="f-l">
							<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
							<a href="javascript:;" onclick="admin_add('添加管理员','emp/create')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a>
						</span>
						
					</div>
					<div class="mt-20 clearfix">
						<table class="table table-border table-bordered table-bg table-hover table-sort">
							<thead>
								<tr class="text-c">
									<th width="25"><input type="checkbox" name="" value=""></th>
									<th width="40">ID</th>
									<th width="150">登陆名</th>
									<th width="150">姓名</th>
									<th width="150">所在部门</th>
									<th width="90">手机</th>
									<th width="150">邮箱</th>
									<th width="130">创建时间</th>
									<th width="100">是否已启用</th>
									<th width="100">操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach($emps as $v)
								<tr class="text-c">
									<td><input type="checkbox" value="{{$v->id}}" name="box"></td>
									<td>{{$v->id}}</td>
									<td>{{$v->name}}</td>
									<td>{{$v->username}}</td>
									<td>
										@if($v->dept)
                      						{{$v->dept->dept_name}}
                      						@else
                      						暂无部门
                      					@endif</td>
									<td>{{$v->phone}}</td>
									<td>{{$v->email}}</td>
									<td>{{$v->created_at}}</td>
									<td class="td-status"><span class="label label-success radius">{{$v->status?'停用':'启用'}}</td>
									<td class="td-manage">
										@if($v->status == '0')
										<a style="text-decoration:none" onClick="admin_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
										@else
										<a style="text-decoration:none" onClick="admin_start(this,'10001')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>
										@endif
										<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','emp/{{$v->id}}/edit')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
										<a title="删除" href="javascript:;" onclick="emp_del(this,'{{$v->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
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

			/*管理员-停用*/
		/*function admin_stop(obj,id){
  			layer.confirm('确认要停用吗？',function(index){
    		//此处请求后台程序，下方是成功后的前台处理……

    			$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
    			$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
    			$(obj).remove();
    			layer.msg('已停用!',{icon: 5,time:1000});
  			});
		}*/

		/*管理员-启用*/
		function admin_start(obj,id){
  			layer.confirm('确认要启用吗？',function(index){
    		//此处请求后台程序，下方是成功后的前台处理……

    			$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
    			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
    			$(obj).remove();
    			layer.msg('已启用!', {icon: 6,time:1000});
  			});
		}
		function admin_edit(title,url){
  			
  			var index = layer.open({
				type: 2,
				title: title,
				content:url,
    			area: ['800px', '600px']
			});
		}

		function emp_del(obj,id){
  			layer.confirm('确认要删除用户吗？',{title:'删除用户'},function(index){
                $.ajax({
					type: 'GET',
					url: '/emp/destroy/'+id,
					dataType: 'json',
					success: function(data){
						$(obj).parents("tr").remove();
						layer.msg('用户已删除!',{icon:1,time:2000});
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
  			layer.confirm('确认要批量删除用户吗？',{title:'批量删除用户'},function(index){


                $.ajax({
					type: 'GET',
					url: '/emp/aajax/'+str,
					dataType: 'json',
					success: function(data){
						layer.msg('用户已删除!',{icon:1,time:2000});
						var index = layer.getFrameIndex(window.name);
								console.log(index);
								location.replace(location.href);
								//parent.$('.btn-refresh').click();
								layer.close(index);
					},
					error:function(data) {
						layer.msg('删除错误!',{icon:2,time:2000});
						var index = layer.getFrameIndex(window.name);

								location.replace(location.href);
								//parent.$('.btn-refresh').click();
								layer.close(index);
					},
				});
  			});
		}

	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection
