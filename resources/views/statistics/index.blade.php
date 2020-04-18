@extends('layouts.app')
@section('content')
<body>
	<div class="wap-container">
		<nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
			首页
			<span class="c-gray en">/</span>
			系统管理
			<span class="c-gray en">/</span>
			系统设置
			<a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>
		<article class="Hui-admin-content clearfix">
			<div class="panel">
				<div class="panel-body">
					<form action="" method="post" class="form form-horizontal" id="form-system-base">
						<div id="tab-system" class="HuiTab">
							<div class="tabBar cl"><span>落地项目</span><span>流转项目</span><span>首谈地项目</span></div>
							<div class="tabCon">
															<div class="mt-20 clearfix">
								<table class="table table-border table-bordered table-bg table-hover table-sort">
									<thead>
										<tr class="text-c">
											<th width="25"><input type="checkbox" name="" value=""></th>
											<th width="40">ID</th>
											<th width="250">项目名称</th>
											<th width="100">资方姓名</th>
											<th width="150">资方联系方式</th>
											<th width=" ">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($info as $v)
										<tr class="text-c">
											<td><input type="checkbox" value="{{$v['id']}}" name="ID"></td>
											<td>{{$v['id']}}</td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_edit('查看','{{route('information.edit',['id'=>$v['id']])}}','{{$v['id']}}')" title="查看">{{$v['name']}}</u></td>
											<td>{{$v['cont_name']}}</td>
											<td>{{$v['cont_phone']}}</td>
											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="admin_role_edit('添加数据','/statistics/add/{{$v['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;添加数据&nbsp;&nbsp;&nbsp;</button>
												
												<button type="submit"  href="javascript:;" onclick="negotiation_create('查看数据','/statistics/{{$v['id']}}')"  class="f-l ml-10 btn btn-primary radius size-S"><i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;查看数据&nbsp;&nbsp;</button>											
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							</div>
							<div class="tabCon">

							</div>
							<div class="tabCon">

							</div>
						</div>

					</form>
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
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
	<script type="text/javascript" src="/static/business/js/main.js"></script>
	<script type="text/javascript">
	$(function(){
		$('.skin-minimal input').iCheck({
			checkboxClass: 'icheckbox-blue',
			radioClass: 'iradio-blue',
			increaseArea: '20%'
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

		$("#form-system-base").validate({
			rules: {
				websiteTitle: {
					required: true,
				},
				websiteKeywords: {
					required: true,
				},
				websiteDescription: {
					required: true,
				},
				websiteStatic: {
					required: true,
				},
				websiteUploadfile: {
					required: true,
				},
				websiteCopyright: {
					required: true,
				},
				websiteIcp: {
					required: true,
				},
			},
			onkeyup: false,
			focusCleanup: true,
			success: "valid",
			submitHandler: function(form){
				$(form).ajaxSubmit();
			}
		});
	});
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection