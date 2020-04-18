
<?php $__env->startSection('content'); ?>
<body>
	<div class="wap-container">
		<nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
			首页
			<span class="c-gray en">/</span>
			项目绩效管理
			<span class="c-gray en">/</span>
			项目绩效列表
			<a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>

		<article class="Hui-admin-content clearfix">

			<div class="panel ">
				<div class="panel-body">
					<div id="tab-system" class="HuiTab">
						<div class="tabBar cl"><span>本区发布的流转项目</span><span>本区可以流转的项目</span><span>本区流转中的项目</span></div>
						<div class="tabCon">
							<div class="mt-20 clearfix">
								<table class="table table-border table-bordered table-bg table-hover table-sort">
									<thead>
										<tr class="text-c">
											<th width="25"><input type="checkbox" name="" value=""></th>
											<th width="40">ID</th>
											<th width="">项目名称</th>
											<th width="100">行业类别</th>
											<th width="120">投资金额</th>
											<th width="100">项目负责人</th>
											<th width="100">联系方式</th>
											<th width="80">流转方向</th>
											<th width="120">流转状态</th>
											<th width="120">流转时间</th>
											<th width="250">操作</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="text-c">
											<td><input type="checkbox" value="<?php echo e($val['id']); ?>" name="ID"></td>
											<td><?php echo e($val['id']); ?></td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','<?php echo e(route('information.show',['id'=>$val['id']])); ?>','<?php echo e($val['id']); ?>')" title="查看"><?php echo e($val['name']); ?></u></td>
											<td><?php echo e($val['industry']); ?></td>
											<td><?php echo e($val['investment']); ?><?php if($val['currency'] =="1"): ?>万人民币<?php elseif($val['currency'] =="2"): ?>万美元<?php elseif($val['currency'] =="3"): ?>万欧元<?php endif; ?></td>
											<td><?php echo e($val['staff_name']); ?></td>
											<td><?php echo e($val['staff_phone']); ?></td>
											<td><?php echo e($val['circule_to']); ?></td>
											<td><?php if($val['result'] == 0): ?>暂无流转<?php elseif($val['result'] == 1): ?><?php echo e($val['circule_n_dept']); ?>流转中<?php endif; ?></td>
											<td><?php echo e($val['updated_at']); ?></td>
											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="cricule_view('查看流转详情','/recode/<?php echo e($val['id']); ?>')"  class="btn btn-success radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe709;</i>&nbsp;&nbsp;查看流转记录&nbsp;&nbsp;&nbsp;</button>
												<button type="submit"  href="javascript:;" onclick="negotiation_create('终止流转','/circule/redit/<?php echo e($val['nego_id']); ?>')"  class="btn btn-danger radius size-S ml-10">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe706;</i>&nbsp;&nbsp;终止流转&nbsp;&nbsp;&nbsp;</button>
												
											</td>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tabCon">
							<div class="mt-20 clearfix">
								<table class="table table-border table-bordered table-bg table-hover table-sort">
									<thead>
										<tr class="text-c">
											<th width="25"><input type="checkbox" name="" value=""></th>
											<th width="40">ID</th>
											<th width="">项目名称</th>
											<th width="100">行业类别</th>
											<th width="120">投资金额</th>
											<th width="100">首谈地</th>
											<th width="100">首谈地联系人</th>
											<th width="100">首谈地联系方式</th>
											<th width="80">流转方向</th>
											<th width="120">流转时间</th>
											<th width="250">操作</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $info1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="text-c">
											<td><input type="checkbox" value="<?php echo e($v['id']); ?>" name="ID"></td>
											<td><?php echo e($v['id']); ?></td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','<?php echo e(route('information.show',['id'=>$v['id']])); ?>','<?php echo e($v['id']); ?>')" title="查看"><?php echo e($v['name']); ?></u></td>
											<td><?php echo e($v['industry']); ?></td>
											<td><?php echo e($v['investment']); ?><?php if($v['currency'] =="1"): ?>万人民币<?php elseif($v['currency'] =="2"): ?>万美元<?php elseif($v['currency'] =="3"): ?>万欧元<?php endif; ?></td>
											<td><?php echo e($v['dept']); ?></td>
											<td><?php echo e($v['staff_name']); ?></td>
											<td><?php echo e($v['staff_phone']); ?></td>
											<td><?php echo e($v['circule_to']); ?></td>
											<td><?php echo e($v['updated_at']); ?></td>
											<td class="td-manage">
												<button type="submit"  href="javascript:;" onclick="cricule_view('查看流转详情','/recode/<?php echo e($v['id']); ?>')"  class="btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;查看流转记录&nbsp;&nbsp;&nbsp;</button>
												<button type="submit"  href="javascript:;" onclick="information_show('申请流转','/circule/start_circule/<?php echo e($v['nego_id']); ?>')"  class="btn btn-primary radius size-S ml-10">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;申请流转&nbsp;&nbsp;&nbsp;</button>
												
											</td>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tabCon">
							<div class="mt-20 clearfix">
								<table class="table table-border table-bordered table-bg table-hover table-sort">
									<thead>
										<tr class="text-c">
											<th width="25"><input type="checkbox" name="" value=""></th>
											<th width="40">ID</th>
											<th width=" ">项目名称</th>
											<th width="80">首谈地</th>
											<th width="100">首谈地联系人</th>
											<th width="100">首谈地联系方式</th>
											<th width="80">流转方向</th>
											<th width="80">流转地</th>
											<th width="100">流转地联系人</th>
											<th width="100">流转地联系方式</th>
											<th width="120">流转时间</th>
											<th width="250">操作</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $info2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="text-c">
											<td><input type="checkbox" value="<?php echo e($k['id']); ?>" name="ID"></td>
											<td><?php echo e($k['id']); ?></td>
											<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="information_show('查看','<?php echo e(route('information.show',['id'=>$k['id']])); ?>','<?php echo e($k['id']); ?>')" title="查看"><?php echo e($k['name']); ?></u></td>
											<td><?php echo e($k['circule_f_dept']); ?></td>
											<td><?php echo e($k['circule_f_name']); ?></td>
											<td><?php echo e($k['circule_f_phone']); ?></td>
											<td><?php echo e($k['circule_to']); ?></td>
											<td><?php echo e($k['circule_n_dept']); ?></td>
											<td><?php echo e($k['circule_n_name']); ?></td>
											<td><?php echo e($k['circule_n_phone']); ?></td>
											<td><?php echo e($k['created_at']); ?></td>
											<td class="td-manage">

												<button type="submit"  href="javascript:;" onclick="cricule_view('查看流转详情','/recode/<?php echo e($k['id']); ?>')"  class="btn btn-primary radius size-S">&nbsp;&nbsp;<i class="Hui-iconfont">&#xe6df;</i>&nbsp;&nbsp;查看流转记录&nbsp;&nbsp;&nbsp;</button>
	
											</td>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
							
						</div>
					</div>
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
	<script type="text/javascript" src="/static/business/js/main.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>


	<script type="text/javascript">
	$(function(){
			runDatetimePicker();
      // 全选 页面调用
      $(".table").HuicheckAll(
        {
          checkboxAll: 'thead input[type="checkbox"]',
          checkbox: 'tbody input[type="checkbox"]'
        },
        function(checkedInfo) {
          console.log(checkedInfo);
        }
      )
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
			function information_add(title,url){
  			var index = layer.open({
    		type: 2,
    		title: title,
    		content: url,
  		});
  			layer.full(index);
		}

		function information_edit(title,url,id){
			var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
			layer.full(index);
		}

										
		function cricule_view(title,url){
			var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
			layer.full(index);
		}

	function information_show(title,url,id){
  		var index = layer.open({
		type: 2,
		title: title,
		content: url,
    	area: ['800px', '600px'],
  		});
	}
  		
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>