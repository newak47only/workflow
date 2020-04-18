@extends('layouts.app')
@section('content')
  <aside class="Hui-admin-aside-wrapper">
    <div class="Hui-admin-logo-wrapper">
      <a class="logo navbar-logo" href="/aboutHui.shtml">
        <i class="va-m iconpic global-logo"></i>
        <span class="va-m">项目库管理</span>
      </a>
    </div>
    <div class="Hui-admin-menu-dropdown bk_2">

      <dl id="menu-negotiation" class="Hui-menu">
        <dt class="Hui-menu-title"><i class="Hui-iconfont">&#xe616;</i>&nbsp;洽谈项目库<i class="Hui-iconfont Hui-admin-menu-dropdown-arrow">&#xe6d5;</i></dt>
        <dd class="Hui-menu-item">
          <ul>
            <li><a data-href="information" data-title="洽谈项目列表" href="javascript:void(0)">洽谈项目列表</a></li>
          </ul>
        </dd>
      </dl>
      <dl id="menu-circulation" class="Hui-menu">
        <dt class="Hui-menu-title"><i class="Hui-iconfont">&#xe616;</i>&nbsp;流转项目库&nbsp;<i class="Hui-iconfont Hui-admin-menu-dropdown-arrow">&#xe6d5;</i></dt>
        <dd class="Hui-menu-item">
          <ul>
            @if($status == 0)
            <li><a data-href="circule" data-title="流转项目表" href="javascript:void(0)">流转项目列表&nbsp;</a></li>
            @elseif($status == 1)
            <li><a data-href="circule/index2" data-title="流转项目表" href="javascript:void(0)">流转项目列表&nbsp;</a></li>
            <li><a data-href="circule/index1" data-title="本区流转项目表" href="javascript:void(0)">本区流转项目列表&nbsp;</a></li>
            @elseif($status ==2)
            <li><a data-href="circule/index2" data-title="流转项目表" href="javascript:void(0)">流转项目列表&nbsp;</a></li>
            @endif
          </ul>
        </dd>
      </dl>
      <dl id="menu-landing" class="Hui-menu">
        <dt class="Hui-menu-title"><i class="Hui-iconfont">&#xe613;</i>&nbsp;落地项目库<i class="Hui-iconfont Hui-admin-menu-dropdown-arrow">&#xe6d5;</i></dt>
         <dd class="Hui-menu-item">
          <ul>
            
            @if($status == 0)
            <li><a data-href="negotiation" data-title="落地项目列表" href="javascript:void(0)">落地项目列表</a></li>
            @elseif($status == 1)
            <li><a data-href="negotiation/index2" data-title="落地项目列表" href="javascript:void(0)">落地项目列表</a></li>
            <li><a data-href="negotiation/index1" data-title="本区落地项目列表" href="javascript:void(0)">本区落地项目列表</a></li>
            @elseif($status ==2)
            <li><a data-href="negotiation/index2" data-title="落地项目列表" href="javascript:void(0)">落地项目列表</a></li>
            @endif
          </ul>
        </dd>
      </dl>
      <dl id="menu-paper" class="Hui-menu">
        <dt class="Hui-menu-title"><i class="Hui-iconfont">&#xe60d;</i>&nbsp;项目资料库<i class="Hui-iconfont Hui-admin-menu-dropdown-arrow">&#xe6d5;</i></dt>
        <dd class="Hui-menu-item">
          <ul>
            @if($status == 0)
            <li><a data-href="uploader" data-title="项目资料列表" href="javascript:void(0)">项目资料列表</a></li>
            @elseif($status == 1)
            <li><a data-href="uploader/index1" data-title="项目资料列表" href="javascript:void(0)">项目资料列表</a></li>
            <li><a data-href="uploader/index2" data-title="本区项目资料列表" href="javascript:void(0)">本区项目资料列表</a></li>
            @elseif($status ==2)
            <li><a data-href="uploader/index2" data-title="项目资料列表" href="javascript:void(0)">项目资料列表</a></li>
            @endif
          </ul>
        </dd>
      </dl>
      @if($status < 2 )
      <dl id="menu-admin" class="Hui-menu">
        <dt class="Hui-menu-title"><i class="Hui-iconfont">&#xe62d;</i>&nbsp;管理员管理<i class="Hui-iconfont Hui-admin-menu-dropdown-arrow">&#xe6d5;</i></dt>
        <dd class="Hui-menu-item">
          <ul>
            <li><a data-href="/dept" data-title="部门管理" href="javascript:void(0)">部门管理</a></li>
            <li><a data-href="/permission" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
            <li><a data-href="/emp" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
          </ul>
        </dd>
      </dl>
      @endif
    </div>
  </aside>
  <div class="Hui-admin-aside-mask"></div>
  <!--/_menu 作为公共模版分离出去-->

  <div class="Hui-admin-dislpayArrow">
    <a href="javascript:void(0);" onClick="displaynavbar(this)">
      <i class="Hui-iconfont Hui-iconfont-left">&#xe6d4;</i>
      <i class="Hui-iconfont Hui-iconfont-right">&#xe6d7;</i>
    </a>
  </div>
  <section class="Hui-admin-article-wrapper">
    <!--_header 作为公共模版分离出去-->
    <header class="Hui-navbar">
      <div class="navbar">
        <div class="container-fluid clearfix">
          <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar">
            <ul class="clearfix">
              <li>{{ $dept_name}}</li>
              <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A">{{ Auth::user()->username }}<i class="Hui-iconfont">&#xe6d5;</i></a>
                <ul class="dropDown-menu menu radius box-shadow">
                  <li><a href="javascript:;" onclick="admin_edit('管理员编辑','emp/{{Auth::user()->id}}/edit')" class="ml-5" style="text-decoration:none">个人信息</a></li>
                  <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">退出</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                        </form>
                  </li>
                </ul>
              </li>
              
              <li id="Hui-skin" class="dropDown dropDown_hover right">
                <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                <ul class="dropDown-menu menu radius box-shadow">
                  <li><a href="javascript:;" data-val="default" title="默认（蓝色）">默认（深蓝）</a></li>
                  <li><a href="javascript:;" data-val="black" title="黑色">黑色</a></li>
                  <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                  <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                  <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                  <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <!--/_header 作为公共模版分离出去-->

    <div id="Hui-admin-tabNav" class="Hui-admin-tabNav">
      <div class="Hui-admin-tabNav-wp">
        <ul id="min_title_list" class="acrossTab clearfix" style="width: 241px; left: 0px;">
          <li class="active"><span title="我的桌面" data-href="welcome.html">我的桌面</span><em></em></li>
        </ul>
      </div>
      <div class="Hui-admin-tabNav-more btn-group" style="display: none;">
        <a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
        <a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
      </div>
    </div>

    <div id="iframe_box" class="Hui-admin-article">
      <div class="show_iframe">
        <iframe id="iframe-welcome" data-scrolltop="0" scrolling="yes" frameborder="0" src="welcome"></iframe>
      </div>
    </div>
  </section>
  <div class="contextMenu" id="Huiadminmenu">
    <ul>
      <li id="closethis">关闭当前 </li>
      <li id="closeother">关闭其他 </li>
      <li id="closeall">关闭全部 </li>
    </ul>
  </div>
  <!--_footer 作为公共模版分离出去-->
  <script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="/lib/layer/3.1.1/layer.js"></script>
  <script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
  <script type="text/javascript" src="/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
  <script type="text/javascript" src="/static/h-ui.admin.pro.iframe/js/h-ui.admin.pro.iframe.min.js"></script>
  <!--/_footer /作为公共模版分离出去-->

  <!--请在下方写此页面业务相关的脚本-->
  <script type="text/javascript" src="/static/business/js/main.js"></script>
  <script type="text/javascript">
        function admin_edit(title,url){
        
        var index = layer.open({
        type: 2,
        title: title,
        content:url,
          area: ['800px', '600px']
      });
    }
  </script>
@endsection
