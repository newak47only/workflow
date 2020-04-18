@extends('layouts.app')
@section('content')
<body style="background-color:#fff">
	<div class="wap-container">
		<div class="panel">
			<div class="panel-body">
				<form action="{{route('permission.update',['id'=>$permission->id])}}" method="post" class="form form-horizontal" id="form-permission-edit">
					{{csrf_field()}}
					{{method_field('PUT')}}
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>父级权限：</label>
						<div class="form-controls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
							<select class="select" name="pid" size="1">
								<option value="0">作为顶级权限</option>
								@foreach($parents as $val)
									<option value="{{$val->id}}" @if($permission->pid == $val->id)selected @endif>{{$val->permissionname}}</option>
								@endforeach
							</select>
							</span> 
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="{{$permission->permissionname}}" placeholder="" id="permissionname" name="permissionname">
						</div>
					</div>

					
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">控制器名：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="{{$permission->controller}}" placeholder="" id="controller" name="controller">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">方法名：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" placeholder="" name="action" id="action" value="{{$permission->controller}}">
						</div>
					</div>

					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>作为导航：</label>
						<div class="form-controls col-xs-8 col-sm-9 skin-minimal">
							<div class="radio-box">
								<input name="is_nav" type="radio" value="1" id="is_nav-1" @if($permission->is_nav == 1) checked @endif>
								<label for="is_nav-1">是</label>
							</div>
							<div class="radio-box">
								<input type="radio" id="is_nav-2" value="2" name="is_nav"  @if($permission->is_nav == 2) checked @endif>
								<label for="is_nav-2">否</label>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--_footer 作为公共模版分离出去-->
	<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="/lib/layer/3.1.1/layer.js"></script>
	<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>

	<!--/_footer /作为公共模版分离出去-->

	<!--请在下方写此页面业务相关的脚本-->
  <script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
  <script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
  <script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
	<script type="text/javascript">
		$(function(){
			//jQuery控制”控制器“和”方法“表单项的动态显示和隐藏
			//初始化时默认隐藏两个表单项
			//$('#controller,#action').parents('.row').hide()
			//给下拉的列表帮定切换事件
			$('select').change(function(){
				//获取当前选中的值
				var _val = $(this).val();

				//判断值
				if(_val > 0){
					//显示
					$('#controller, #action').parents('.row').show(500);
				}else{
					//重置表单项的值
					$('#controller, #action').val('');
					//隐藏
					$('#controller, #action').parents('.row').hide(500);
				}
			});
			/* 通过iCheck插件，美化checkbox */
			$('.skin-minimal input').iCheck({
				checkboxClass: 'icheckbox-blue',
				radioClass: 'iradio-blue',
				increaseArea: '20%'
			});

			/* 表单验证，提交 */
			$("#form-permission-edit").validate({
				rules:{
					permissionname:{
						required:true,
						minlength:4,
						maxlength:16
					},
					is_nav:{
						required:true,
					},
					pid:{
						required:true,
					},
				},
				onkeyup:false,
				focusCleanup:true,
				success:"valid",
				submitHandler:function(form){
					$(form).ajaxSubmit({
						success:function(data){
							if( data == '1'){
								layer.msg('权限编辑成功！',{ icon: 1,time:2000},function(){
								var index = parent.layer.getFrameIndex(window.name);
								parent.location.replace(parent.location.href);
								parent.layer.close(index);
								});

							}else{
								layer.msg('权限编辑失败！',{ icon: 2,time:2000});
							}
						},
						error:function(XmlHttpRequest,textStatus,errorThrown){
							layer.msg('权限编辑错误！',{ icon: 1,time:1000});
						}
					});
				}
			});
		});
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection
