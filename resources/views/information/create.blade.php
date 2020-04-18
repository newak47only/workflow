@extends('layouts.app')
@section('content')
<body style="background-color:#fff">
	<div class="wap-container">
		<div class="panel">
			<div class="panel-body">
				<form action="{{route('information.store')}}" method="post" class="form form-horizontal" id="form-informatian-add">
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>项目名称：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="" placeholder="" id="name" name="name" >
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>行业类别：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" autocomplete="off" value="" placeholder="行业类别" id="industry" name="industry">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>货币类型：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<span class="select-box" style="width:150px;">
							<select class="select" name="currency" size="1">
              					<option value="1">人民币</option>
              					<option value="2">美元</option>
              					<option value="3">欧元</option>             			
							</select>
							</span>
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>投资金额：：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="" placeholder="注意：投资金额货币单位为（万元）" id="investment" name="investment">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>资方联系人：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="" placeholder="" id="cont_name" name="cont_name">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>资方联系方式：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" placeholder="" name="cont_phone" id="cont_phone">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">项目简介：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<textarea name="content" cols="" rows=""  class="textarea textarea-article"  placeholder="项目简介" dragonfly="true" onKeyUp="textarealength(this,100)"></textarea>
							<p class="textarea-numberbar">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">项目诉求：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<textarea name="appeal" cols="" rows=""  class="textarea textarea-article"  placeholder="项目诉求" dragonfly="true" onKeyUp="textarealength(this,100)"></textarea>
							<p class="textarea-numberbar">
						</div>
					</div>
					<input type="hidden" name="emp_id" value="{{$emp_id}}">
					<input type="hidden" name="staff_name" value="{{$emp->username}}">
					<input type="hidden" name="staff_phone" value="{{$emp->phone}}">
					{{csrf_field()}}
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
  <script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script>
  <script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.config.js"></script>
  <script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
  <script type="text/javascript" src="/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
  <script type="text/javascript" src="/static/business/js/main.js"></script>
	<script type="text/javascript">
		$(function(){
			/* 通过iCheck插件，美化checkbox */
			$('.skin-minimal input').iCheck({
				checkboxClass: 'icheckbox-blue',
				radioClass: 'iradio-blue',
				increaseArea: '20%'
			});

			/*长文本设置*/
			$(".textarea-article").Huitextarealength({
				minlength: 10,
				maxlength: 500
			});

			/* 表单验证，提交 */
			$("#form-informatian-add").validate({
				rules:{
					name:{
						required:true,
						maxlength:30
					},
					cont_name:{
						required:true,
					},
					cont_phone:{
						required:true,
						isPhone:true,
					},
					currency:{
						required:true,
					},
					investment:{
						required:true,
					},
					industry:{
						required:true,
						maxlength:16
					},
					content:{
						required:true,
						maxlength:300
					},
					appeal:{
						required:true,
						maxlength:300
					},
					
				},
				onkeyup:false,
				focusCleanup:true,
				success:"valid",
				submitHandler:function(form){
					$(form).ajaxSubmit({
						type:'post',
						url:"{{route('information.store')}}",
						success:function(data){
							if( data == '1'){
								layer.msg('洽谈项目添加成功！',{ icon: 1,time:2000},function(){
								var index = parent.layer.getFrameIndex(window.name);
								parent.location.replace(parent.location.href);
								parent.layer.close(index);
								});

							}else{
								layer.msg('洽谈项目添加失败！',{ icon: 2,time:2000});
							}
						},
						error:function(XmlHttpRequest,textStatus,errorThrown){
							layer.msg('洽谈项目添加错误！',{ icon: 1,time:1000});
						}
					});
				}
			});
		});
		
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection
