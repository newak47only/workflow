@extends('layouts.app')
@section('content')
<body style="background-color:#fff">
	<div class="wap-container">
		<div class="panel">
			<div class="panel-body">

				
				<form action="{{route('negotiation.update',['id'=>$negotiation->id])}}" method="POST" class="form form-horizontal" id="form-admin-add" >
				<div class="row clearfix">
					<table class="table">
      				<tbody>
       					 <tr>
          					<th class="text-r" width="80">项目名称：</th>
          					<td>{{$info_name}}</td>
        				</tr>
        				<tr>
          					<th class="text-r">投资金额：</th>
          					<td>@if($negotiation->currency == '1')万人民币@elseif($negotiation->currency == '2')万美元@elseif($negotiation->currency == '3')万欧元@endif
          					</td>
        				</tr>
        				<tr>
          					<th class="text-r">签约日期：</th>
          					<td>{{$negotiation->neg_at}}</td>
        				</tr>
        				<tr>
          					<th class="text-r">合同文件：</th>
          					<td>{{$negotiation->contract_file}}</td>
        				</tr>
        				<tr>
          					<th class="text-r">落地说明：</th>
          					<td>{{$negotiation->remark}}</td>
        				</tr>
      				</tbody>
    				</table>
    			</div>
					<div class="row clearfix">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>审核意见：</label>
						<div class="form-controls col-xs-8 col-sm-9">
							<textarea type="text" class="textarea" value="{{$negotiation->report}}" placeholder="" id="report" name="report" datatype="*4-16" ></textarea>
						</div>
					</div>
					<input type="hidden" name="info_id" value="{{$negotiation->info_id}}">
					{{csrf_field()}}
					{{method_field('PUT')}}

					<div class="row clearfix">
						<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
							<button class="btn btn-primary radius" type="submit" name="status" value="1">审核通过</button>
							<button class="btn btn-primary radius" type="submit" name="status" value="2">审核未通过</button>
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
				submitHandler:function(form){
					$(form).ajaxSubmit();
					var index = parent.layer.getFrameIndex(window.name);
					parent.location.replace(parent.location.href)
					parent.layer.close(index);
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
