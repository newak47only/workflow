
<?php $__env->startSection('content'); ?>
<body>
	<div class="wap-container">
		<article class="Hui-admin-content clearfix">
			<div class="row-24 clearfix" style="margin-left: -12px; margin-right: -12px;">
				<div class="col-24-xs-24 col-24-sm-12 col-24-md-12 col-24-lg-12 col-24-xl-6" style="padding-left: 12px; padding-right: 12px; margin-bottom: 24px;" >
					<div class="panel" >
						<div class="panel-header" style="padding:15px 24px;font-weight: 400;color:#999;">在库项目总数：</div>
						<div class="panel-body" style="padding:0 24px;">
							<div class="c-primary text-c mt-10" style="font-size: 36px;line-height: 38px;padding-bottom: 24px; ">
								<?php echo e($info_count); ?>

							</div>
							<div class="f-14" style="padding: 10px 0;border-top:solid 1px #eee"><span class="c-999">今日入库项目</span> <span><?php echo e($info_new_count); ?>个</span></div>
						</div>
					</div>
				</div>
				<div class="col-24-xs-24 col-24-sm-12 col-24-md-12 col-24-lg-12 col-24-xl-6" style="padding-left: 12px; padding-right: 12px; margin-bottom: 24px;">
					<div class="panel">
						<div class="panel-header" style="padding:15px 24px;font-weight: 400;color:#999;">洽谈项目总数：</div>
						<div class="panel-body" style="padding:0 24px;">
							<div class="c-success text-c mt-10" style="font-size: 36px;line-height: 38px;padding-bottom: 24px;">
								<?php echo e($info_nego_count); ?>

							</div>
							<div class="f-14" style="padding: 10px 0;border-top:solid 1px #eee"><span class="c-999">进度记录总共</span> <span><?php echo e($recode_count); ?>条</span></div>
						</div>
					</div>
				</div>
				<div class="col-24-xs-24 col-24-sm-12 col-24-md-12 col-24-lg-12 col-24-xl-6" style="padding-left: 12px; padding-right: 12px; margin-bottom: 24px;">
					<div class="panel">
						<div class="panel-header" style="padding:15px 24px;font-weight: 400;color:#999;">流转项目总数：</div>
						<div class="panel-body" style="padding:0 24px;">
							<div class="c-danger text-c mt-10" style="font-size: 36px;line-height: 38px;padding-bottom: 24px;">
								<?php echo e($info_cir_count); ?>

							</div>
							<div class="f-14" style="padding: 10px 0;border-top:solid 1px #eee"><span class="c-999">您的流转项目</span> <span>12个</span></div>
						</div>
					</div>
				</div>
				<div class="col-24-xs-24 col-24-sm-12 col-24-md-12 col-24-lg-12 col-24-xl-6" style="padding-left: 12px; padding-right: 12px; margin-bottom: 24px;">
					<div class="panel">
						<div class="panel-header" style="padding:15px 24px;font-weight: 400;color:#999;">落地项目总数：</div>
						<div class="panel-body" style="padding:0 24px;">
							<div class="c-warning text-c mt-10" style="font-size: 36px;line-height: 38px;padding-bottom: 24px;">
								<?php echo e($info_land_count); ?>

							</div>
							<div class="f-14" style="padding: 10px 0;border-top:solid 1px #eee"><span class="c-999">今日新增</span> <span>1,234</span></div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-secondary">
				<div class="panel-header">宁波市重大招商项目信息库（流转平台）使用说明</div>
				<div class="panel-body">面板内容</div>
			</div>
			
		</article>
		
	</div>
	<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="lib/layer/3.1.1/layer.js"></script>
	<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>

	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript" src="static/business/js/main.js"></script>
</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>