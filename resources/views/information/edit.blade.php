@extends('layouts.app')
@section('content')
<body style="background-color:#fff">
	<div class="wap-container">
		<div class="panel">
			<div class="panel-body">
				<form action="{{route('information.update',['id'=>$information->id])}}" method="post" class="form form-horizontal" id="form-informatian-update">
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>项目名称：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text"  placeholder="" id="name" value="{{$information->name}}" name="name">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>行业类别：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text"  placeholder="" id="industry" value="{{$information->industry}}" name="industry">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>货币类型：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<span class="select-box" style="width:150px;">
							<select class="select"  name="currency" size="1">
              					<option value="{{$information->currency}}" selected="selected">@if($information->currency =="1")人民币@elseif($information->currency =="2")美元@endif</option>
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
							<input type="text" class="input-text" placeholder="投资金额" name="investment" id="investment" value="{{$information->investment}}">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>资方联系人：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text"  placeholder="" id="cont_name" name="cont_name" value="{{$information->cont_name}}">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>资方联系方式：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<input type="text" class="input-text" placeholder="" value="{{$information->cont_phone}}" id="cont_phone" name="cont_phone">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">项目简介：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<textarea name="content"  cols="" rows=""  class="textarea textarea-article"   dragonfly="true" onKeyUp="textarealength(this,100)">{{$information->content}}"</textarea>
							<p class="textarea-numberbar">
						</div>
					</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3">项目诉求：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<textarea name="appeal"  cols="" rows=""  class="textarea textarea-article"  placeholder="项目诉求300个字符以内" dragonfly="true" onKeyUp="textarealength(this,100)">{{$information->appeal}}</textarea>
							<p class="textarea-numberbar">
						</div>
					</div>
					<input type="hidden" name="emp_id" value="{{$information->emp_id}}">
					{{csrf_field()}}
					{{method_field('PUT')}}
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
			$("#form-informatian-update").validate({
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
						url: ,
						success:function($data){
							layer.msg('添加成功！',{ icon: 1,time:1000},function(){
								var index = parent.layer.getFrameIndex(window.name);
								parent.location.replace(parent.location.href);
								//parent.$('.btn-refresh').click();
								parent.layer.close(index);
							});
						},
						error:function(XmlHttpRequest,textStatus,errorThrown){
							layer.msg('添加错误！',{ icon: 1,time:1000},function(){
								var index = parent.layer.getFrameIndex(window.name);
								parent.location.replace(parent.location.href);
								//parent.$('.btn-refresh').click();
								parent.layer.close(index);
							});
						}
					});
				}
			});
		});
		
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection
