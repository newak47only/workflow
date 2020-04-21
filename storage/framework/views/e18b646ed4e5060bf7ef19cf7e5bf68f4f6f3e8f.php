
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="Bookmark" href="favicon.ico" >
  <link rel="Shortcut Icon" href="favicon.ico" />
  <!--[if lt IE 9]>
  <script type="text/javascript" src="lib/html5.js"></script>
  <script type="text/javascript" src="lib/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
  <link rel="stylesheet" type="text/css" href="/static/h-ui.admin.pro.iframe/css/h-ui.admin.pro.iframe.min.css" />
  <link rel="stylesheet" type="text/css" href="/static/h-ui.admin.pro.iframe/css/H-ui.login.min.css" />
  <link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.9/iconfont.css" />
  <link rel="stylesheet" type="text/css" href="/static/h-ui.admin.pro.iframe/skin/default/skin.css" id="skin" />
  <link rel="stylesheet" type="text/css" href="/static/business/css/style.css" />
  <link rel="stylesheet" type="text/css" href="/webuploader-0.1.5/webuploader.css" />
  
  <script src="/vendor/toastr/build/toastr.min.js" type="text/javascript"></script>
  <!--[if IE 6]>
  <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
  <script>DD_belatedPNG.fix('*');</script>
  <![endif]-->
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;

        $(function(){
             $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
        });
    </script>
    <title>宁波市重大招商项目信息库（流转平台）</title>
  <meta name="keywords" content="宁波市重大招商项目信息库（流转平台）" />
  <meta name="description" content="宁波市重大招商项目信息库（流转平台）" />
</head>

    

        <?php echo $__env->yieldContent('content'); ?>

</html>
