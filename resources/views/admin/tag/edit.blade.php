<!DOCTYPE HTML>
<html>
<head>
<title>后台 --云标签修改</title>
@include('public.header')
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- 侧边栏 开始-->
        @include('public.sidebar')
        <!-- 侧边栏 结束 -->
        
        <!-- 头部 开始 -->
        @include('public.header_userinfo')
        <!-- 头部 结束 -->

        <!-- 主体内容 开始-->
        <div id="page-wrapper">

            <div class="main-page">
                <div class="forms" style="width:960px;margin:auto;">
                    <h3 class="title1">云标签管理</h3>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger" style="margin:10px 0px 0px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class=" form-grids row form-grids-right">
                      <div class="widget-shadow " data-example-id="basic-forms">
                        <div class="form-title">
                          <h4>添加云标签 :</h4></div>
                        <div class="form-body">
                          <form action="/admin/tag/update" method="post" enctype="multipart/form-data" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="tid" value="{{$data->tid}}">
                            <div class="form-group">
                              <label for="tname" class="col-sm-2 control-label">云标签名</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $data->tname }}" name="tname" id="tname" placeholder="标签名"></div>
                            </div>
                            <div class="form-group">
                              <label for="bgcolor" class="col-sm-2 control-label">背景色</label>
                              <div class="col-sm-9" style="width:30%;">
                                <input type="color" class="form-control" id="bgcolor" value="{{ $data->bgcolor }}" name="bgcolor" placeholder="云标签的背景色"></div>
                            </div>
                            <div class="col-sm-offset-2">
                                <button type="submit" class="btn btn-default">提交</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="main-page" style="display: none;">
                <div class="row calender widget-shadow">
                    <div class="cal1">
                        
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <!-- 主体内容 结束-->

        <!-- 页脚 开始 -->
        @include('public.footer')
        <!-- 页脚 结束 -->
    </div>
    <!-- 页脚 静态 资源 -->
    @include('public.footer_static')
</body>
</html>