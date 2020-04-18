@extends('layouts.app')
@section('content')
<body style="background-color:#fff">
	<div class="wap-container">
		<div class="panel">
			<div class="panel-body">
				<form action="/emp" method="post" class="form form-horizontal" id="form-admin-add">
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="" placeholder="" id="name" name="name">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password2" name="password2">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="" placeholder="" id="username" name="username">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="" placeholder="" id="phone" name="phone">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" placeholder="@" name="email" id="email">
						</div>
					</div>
					
					
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">所在部门：</label>
						<div class="form-controls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
							<select class="select" name="dept_id" size="1">
              					@foreach($depts as $v)
              					<option value="{{$v->id}}">{{$v->dept_name}}</option>
              					@endforeach
							</select>
							</span> </div>
					</div>
					{{csrf_field()}}
					{{method_field('POST')}}
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
			/* 通过iCheck插件，美化checkbox */
			$('.skin-minimal input').iCheck({
				checkboxClass: 'icheckbox-blue',
				radioClass: 'iradio-blue',
				increaseArea: '20%'
			});

			/* 表单验证，提交 */
			$("#form-admin-add").validate({
				rules:{
					name:{
						required:true,
						minlength:2,
						maxlength:16
					},
					password:{
						required:true,
					},
					password2:{
						required:true,
						equalTo: "#password"
					},
					
					phone:{
						required:true,
						isPhone:true,
					},
					email:{
						required:true,
						email:true,
					},
					
					
				},
				onkeyup:false,
				focusCleanup:true,
				success:"valid",
				success:"valid",
				submitHandler:function(form){
					$(form).ajaxSubmit({
						success:function(data){
							if( data == '1'){
								layer.msg('用户添加成功！',{ icon: 1,time:2000},function(){
								var index = parent.layer.getFrameIndex(window.name);
								parent.location.replace(parent.location.href);
								parent.layer.close(index);
								});

							}else{
								layer.msg('用户添加失败！',{ icon: 2,time:2000});
							}
						},
						error:function(XmlHttpRequest,textStatus,errorThrown){
							layer.msg('用户错误！',{ icon: 1,time:1000});
						}
					});
				}
			});
		});
		function admin_add(title,url){
  			var index = layer.open({
			type: 2,
			title: title,
			content: url,
   	 		area: ['800px', '600px']
		});
		}
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection

