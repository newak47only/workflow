@extends('layouts.app')

@section('content')
<body style="background-color:#fff">
	<div class="wap-container">
		<div class="panel">
			<div class="panel-body">
				<form action="{{route('dept.update',['id'=>$dept->id])}}" method="POST" class="form form-horizontal" id="dept_edit">
          		{{csrf_field()}}
          		{{method_field('PUT')}}
				<div class="row clearfix">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>部门名称：</label>
					<div class="form-controls col-xs-8 col-sm-9">
						<input type="text" class="input-text" id="dept_name" name="dept_name" placeholder="部门名称" required value="{{$dept->dept_name}}" >
					</div>
				</div>

				<div class="row clearfix">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级部门：</label>
					<div class="form-controls col-xs-8 col-sm-9"><span class="select-box" >
						<select class="select" name="pid">
						    <option value="0">无</option>
              				@foreach($depts as $v)
              				<option value="{{$v->id}}" @if($dept->pid==$v->id) selected="selected" @endif >{{$v->html}}{{$v->dept_name}}</option>
              				@endforeach
              			</select>
              			</span>
					</div>
				</div>

				<div class="row clearfix">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>部门主管：</label>
					<div class="form-controls col-xs-8 col-sm-9"><span class="select-box" >
						<select class="select" name="director_id">
              				<option value="0">无</option>
              				@foreach($emps as $v)
              				<option value="{{$v->id}}" @if($dept->director_id==$v->id) selected="selected" @endif >{{$v->name}}</option>
              				@endforeach
            			</select>
            		</span>
					</div>
				</div>

				<div class="row clearfix">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>部门副主管：</label>
					<div class="form-controls col-xs-8 col-sm-9"><span class="select-box" >
						<select class="select" name="manager_id">
              			<option value="0">无</option>
              				@foreach($emps as $v)
              				<option value="{{$v->id}}" @if($dept->manager_id==$v->id) selected="selected" @endif >{{$v->name}}</option>
              				@endforeach
          			  </select>
          				</span>
					</div>
				</div>

				<div class="row clearfix">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>部门排序：</label>
					<div class="form-controls col-xs-8 col-sm-9">
						<input type="text" class="input-text"  placeholder="" id="rank" name="rank" datatype="*4-16"  required value="{{$dept->rank}}">
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
	<script type="text/javascript" src="/static/h-ui.admin.pro/js/h-ui.admin.pro.min.js"></script>

	<!--/_footer /作为公共模版分离出去-->

	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
	<script type="text/javascript">
	$(function(){
		

		$("#dept_edit").validate({
			rules:{
				dept_name:{
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
								layer.msg('部门编辑成功！',{ icon: 1,time:2000},function(){
								var index = parent.layer.getFrameIndex(window.name);
								parent.location.replace(parent.location.href);
								parent.layer.close(index);
								});

							}else{
								layer.msg('部门编辑失败！',{ icon: 2,time:2000});
							}
						},
						error:function(XmlHttpRequest,textStatus,errorThrown){
							layer.msg('伯母编辑错误！',{ icon: 1,time:1000});
						}
					});
				}
		});
	});
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
@endsection
