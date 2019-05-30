<!DOCTYPE HTML>
<html>
<head>
<title>后台 --用户创建</title>
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
                    <h3 class="title1">用户管理</h3>
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
                          <h4>添加用户 :</h4></div>
                        <div class="form-body">
                          <form action="/admin/user/store" method="post" enctype="multipart/form-data" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="uname" class="col-sm-2 control-label">用户名</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ old('uname') }}" name="uname" id="uname" placeholder="不能超过24个英文字母"></div>
                            </div>
                            <div class="form-group">
                              <label for="upwd" class="col-sm-2 control-label">密码</label>
                              <div class="col-sm-9">
                                <input type="password" class="form-control" id="upwd" name="upwd" placeholder="6~12位(字母、数字、下划线)"></div>
                            </div>
                            <div class="form-group">
                              <label for="reupwd" class="col-sm-2 control-label">确认密码</label>
                              <div class="col-sm-9">
                                <input type="password" class="form-control" id="reupwd" name="reupwd"></div>
                            </div>
                            <div class="form-group">
                                <label for="uface" class="col-sm-2 control-label">头像</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="uface" name="uface">
                                </div>
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