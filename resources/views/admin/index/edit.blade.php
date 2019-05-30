<!DOCTYPE HTML>
<html>
<head>
<title>后台 --密码修改</title>
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
                    <h3 class="title1">密码修改</h3>
                    @include('public.message')
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
                        <div class="form-body">
                          <form action="/admin/index/update" method="post" enctype="multipart/form-data" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="oldpwd" class="col-sm-2 control-label">原密码</label>
                              <div class="col-sm-9">
                                <input type="hidden" name="uid" value="{{$data->uid}}">
                                <input type="password" class="form-control" id="oldpwd" name="oldpwd"></div>
                            </div>
                            <div class="form-group">
                              <label for="newpwd" class="col-sm-2 control-label">新密码</label>
                              <div class="col-sm-9">
                                <input type="password" class="form-control" id="newpwd" name="newpwd" placeholder="6~12位(字母、数字、下划线)"></div>
                            </div>
                            <div class="form-group">
                              <label for="repwd" class="col-sm-2 control-label">确认密码</label>
                              <div class="col-sm-9">
                                <input type="password" class="form-control" id="repwd" name="repwd"></div>
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