@extends('layouts.app')
@section('content')
<body style="background-color:#fff">
	<div class="wap-container">
		<div class="panel">
			<div class="panel-body">
				<form action="/completion" method="POST" class="form form-horizontal" id="form_report_create">

          {{csrf_field()}}
				<div class="row clearfix">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>项目名称：</label>
					<div class="form-controls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="{{$informations->name}}" placeholder="{{$informations->name}}" id="report_name" name="  " datatype="*4-16" >
					</div>
				</div>				
				<input type="hidden" class="input-text" value="{{$users->currency}}"   name="currency" >
				<div class="row clearfix">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>投资金额：</label>
					<div class="form-controls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="{{$informations->investment}} " placeholder="{{$informations->investment}}" id="report_investment" name="investment" datatype="*4-16" >
						@if($informations->currency == '1')该项目投资金额单位为：万人民币@elseif($informations->currency == '2')该项目投资金额单位为：万美元@elseif($informations->currency == '3')该项目投资金额单位为：万欧元@endif
					</div>
					
				</div>
				<input type="hidden"  value="{{$informations->currency}}" placeholder="" id="report_currency" name="currency" >

				<input type="hidden"  value="{{$informations->id}}" placeholder="" id="report_info_id" name="info_id" >
				<input type="hidden"  value="{{$eaction}}" placeholder="" id="report_eaction" name="eaction" >
				<div class="row clearfix">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上传文件：</label>
					<div class="form-controls col-xs-8 col-sm-9">
						<span class="btn-upload">
							<a href="javascript:void();" class="btn btn-primary radius btn-upload"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
							<input type="file" multiple name="contract_file" id="report_contract_file" class="input-file">
						</span>
					</div>
				</div>
				<div class="row clearfix">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>开工说明：</label>
					<div class="form-controls col-xs-8 col-sm-9">
						<textarea type="text" class="textarea" value="" placeholder="" id="remark" name="remark" datatype="*4-16" ></textarea>
					</div>
				</div>
				<input type="hidden" class="input-text" value="{{$actiontype}}"   name="actiontype" >
				<div class="row clearfix">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
						<button type="submit" class="btn btn-success radius" id="" name="admin_report_create"><i class="icon-ok"></i> 提交</button>
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
	<script type="text/javascript" src="/static/h-ui.admin.pro/js/h-ui.admin.pro.min.js"></script>

	<!--/_footer /作为公共模版分离出去-->

	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
	<script type="text/javascript">
	$(function(){
			/* 表单验证，提交 */
			$("#form-report-create").validate({
				rules:{
					name:{
						required:true,
					},
					
				},
				onkeyup:false,
				focusCleanup:true,
				success:"valid",
				submitHandler:function(form){
					$(form).ajaxSubmit({
						type:'post',
						url:,
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

	}	
		
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection
