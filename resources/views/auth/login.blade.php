
@extends('layouts.app')
@section('content')
<body>
  <input type="hidden" id="TenantId" name="TenantId" value="" />
  <div class="header"></div>
  <div class="loginWraper">
    <div class="loginBox">
      <form id="form-admin-login" class="form form-horizontal" action="{{ route('login') }}" role="form" method="post">
         {{ csrf_field() }}
        <div class="row clearfix">
          <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
          <div class="form-controls col-xs-7">
            <input id="adminName" name="name" type="name" placeholder="用户名" class="input-text size-L" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                     @endif
            
          </div>
        </div>
        <div class="row clearfix">
          <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
          <div class="form-controls col-xs-7">
            <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L" required>
            @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
             
          </div>
        </div>
        <div class="row clearfix">
          <div class="form-controls col-xs-7 col-xs-offset-3">
            <input id="verificationCode" name="verificationCode" class="input-text size-L" type="text" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="" style="width:150px;" >
            <img src="{{Captcha_src()}}" onclick="this.src='{{captcha_src()}}'+Math.random()" />
            <a id="kanbuq" href="javascript:;">换一张</a>
          </div>
        </div>
        <div class="row clearfix">
          <div class="form-controls col-xs-7 col-xs-offset-3">
            <label for="online">
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
          使我保持登录状态
            </label>
          </div>
        </div>
        <div class="row clearfix">
          <div class="form-controls col-xs-8 col-xs-offset-3">
            <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
            <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;"><a href="/register">机构注册</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="footer">Copyright 宁波市商务局 </div>

  <script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
  <script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
  <script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
  <script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
  <script type="text/javascript">

  </script>

</body>
@endsection
