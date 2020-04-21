@extends('layouts.app')
@section('content')
<body style="background-color:#fff">
	<div class="wap-container">
		<div class="panel">
			<div class="panel-body">
				<form action="{{route('recode.store')}}" method="post" class="form form-horizontal" id="form-admin-add">
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>洽谈对象：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="{{$information->cont_name}}" placeholder="" id="elephant" name="elephant" required>
						</div>
					</div>
					
					<div class="row clearfix skin-minimal">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>洽谈方式：</label>
						<div class="radio-box">
							<input type="radio"  placeholder="" id="radio-1" name="mode" value="手机" checked>
							<label for="radio-1">手机</label>
						</div>
						<div class="radio-box">
							<input type="radio"  placeholder="" id="radio-2" name="mode" value="微信">
							<label for="radio-2">微信</label>
						</div>
						<div class="radio-box">
							<input type="radio"  placeholder="" id="radio-3" name="mode" value="邮件">
							<label for="radio-3">邮件</label>
						</div>
						<div class="radio-box">
							<input type="radio"  placeholder="" id="radio-4" name="mode" value="面谈">
							<label for="radio-4">面谈</label>
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>洽谈内容：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<textarea type="text" class="textarea" value="" placeholder="" id="content" name="content" datatype="*4-16" ></textarea>
						</div>
					</div>
					<input type="hidden" name="emp_id" value="{{$information->emp_id}}">
					<input type="hidden" name="info_id" value="{{$information->id}}">
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
					elephant:{
						required:true,
						minlength:2,
						maxlength:16
					},
					
					mode:{
						required:true,
					},
					content:{
						required:true,
					},
					
					
				},
				onkeyup:false,
				focusCleanup:true,
				success:"valid",
				submitHandler:function(form){
					$(form).ajaxSubmit({
						type:'post',
						url:'{{route('recode.store')}}',
						success:function($data){
							layer.msg('添加成功！',{ icon: 1,time:1000},function(){
								var index = parent.layer.getFrameIndex(window.name);
								console.log(index);
								parent.location.replace(parent.location.href);
								//parent.$('.btn-refresh').click();
								parent.layer.close(index);
							});
						},
						error:function(XmlHttpRequest,textStatus,errorThrown){
							layer.msg('添加错误！',{ icon: 1,time:1000},function(){
								var index = parent.layer.getFrameIndex(window.name);
								console.log(index);
								parent.location.replace(parent.location.href);
								//parent.$('.btn-refresh').click();
								parent.layer.close(index);
							});
						},
					});
				},
			});
		});

		function information_show(title,url){
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
