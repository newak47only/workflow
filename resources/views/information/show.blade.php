@extends('layouts.app')
@section('content')
<body>

  <div class="pd-20">
    <table class="table table-border table-bordered table-hover">
      <tbody>
        @foreach($info as $v)
        <tr>
          <th class="text-r" width="100">项目名称：</th>
          <td colspan='5'>{{$v['name']}} </td>

        </tr>
        <tr>
          <th class="text-r">项目类型：</th>
          <td colspan='2'>{{$v['industry']}} </td>
          <th class="text-r" width="100">投资金额：</th>
          <td colspan='2'>{{$v['investment']}}@if($v['currency'] =='0')万人民币
                    @elseif($v['currency'] =='1')万美元
                    @elseif($v['currency'] =='2')万欧元
                    @endif </td>
        </tr>
        <tr>
          <th class="text-r" width="100">资方联系人：</th>
          <td colspan='2'>{{$v['cont_name']}} </td>
          <th class="text-r" width="100">资方联系方式：</th>
          <td colspan='2'>{{$v['cont_phone']}} </td>
        </tr>
        @if($v['circule_n_name'] == '0')

        <tr>
          <th class="text-r" width="100">首谈地：</th>
          <td>{{$v['circule_f_dept']}} </td>
          <th class="text-r" width="100">首谈地联系人：</th>
          <td>{{$v['circule_f_name']}} </td>
          <th class="text-r" width="100">首谈地联系方式：</th>
          <td>{{$v['circule_f_phone']}} </td>
        </tr>

        @else
        <tr>
          <th class="text-r" width="100">首谈地：</th>
          <td>{{$v['circule_f_dept']}} </td>
          <th class="text-r" width="100">首谈地联系人：</th>
          <td>{{$v['circule_f_name']}} </td>
          <th class="text-r" width="100">首谈地联系方式：</th>
          <td>{{$v['circule_f_phone']}} </td>
        </tr>
        <tr>
          <th class="text-r" width="100">落户地：</th>
          <td>{{$v['circule_n_dept']}} </td>
          <th class="text-r" width="100">落户地联系人：</th>
          <td>{{$v['circule_n_name']}} </td>
          <th class="text-r" width="100">落户地联系方式：</th>
          <td>{{$v['circule_n_phone']}} </td>
        </tr>
        @endif
        <tr>
          <th class="text-r" >项目简介：</th>
          <td colspan='5'>{{$v['content']}} </td>
        </tr>
        <tr>
          <th class="text-r" >项目诉求：</th>
          <td colspan='5'>{{$v['appeal']}} </td>
        </tr>

      

        @endforeach
      </tbody>
    </table>
  </div>
  <!--_footer 作为公共模版分离出去-->
  <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="lib/layer/3.1.1/layer.js"></script>
  <script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
  <!--/_footer /作为公共模版分离出去-->
</body>
@endsection
