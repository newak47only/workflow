@extends('layouts.app')
@section('content')
<body style="background-color:#fff">
	<div class="wap-container">
		<div class="panel">
			<div class="panel-body">

				
				<form action="{{route('circule.update',['id'=>$negotiation->id])}}" method="post"  class="form form-horizontal" id="form-admin-add" >
				<div class="row clearfix">
					<table class="table table-border table-bordered" style="width: 600px; margin-left: 100px">
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
          					<th class="text-r">入库日期：</th>
          					<td>{{$negotiation->created_at}}</td>
        				</tr>
        				<tr>
          					<th class="text-r">相关文件：</th>
          					<td>{{$negotiation->contract_file}}</td>
        				</tr>
        				<tr>
          					<th class="text-r">流转原因：</th>
          					<td>{{$negotiation->remark}}</td>
        				</tr>
        				<tr>
          					<th class="text-r">流转结果：</th>
          					<td><textarea type="text" class="textarea" value=" " placeholder="" id="check" name="report" datatype="*4-16" ></textarea></td>
        				</tr>

						<input type="hidden" name="info_id" value="{{$negotiation->info_id}}">

						{{csrf_field()}}
						{{method_field('PUT')}}
        				<tr>
          					<th class="text-r">流转操作：</th>
          					<td>					
          						<div class="row clearfix">
									<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
										<button class="btn btn-primary radius" type="submit" value="4" name="result" >流转成功</button>
										<button class="btn btn-primary radius ml-30" type="submit" value="3" name="result" >流转失败</button>
									</div>
								</div>
							</td>
        				</tr>
      				</tbody>
    				</table>
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
					$(form).ajaxSubmit({
						success:function(data){
							if( data == '1'){
								layer.msg('流转成功转，入落地项目库！',{ icon: 1,time:2000},function(){
								var index = parent.layer.getFrameIndex(window.name);
								parent.location.replace(parent.location.href);
								parent.layer.close(index);
								});

							}else{
								layer.msg('流转成功，转入落地项目库失败！',{ icon: 2,time:2000});
							}
						},
						error:function(XmlHttpRequest,textStatus,errorThrown){
							layer.msg('项目洽谈转入错误！',{ icon: 1,time:1000});
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
