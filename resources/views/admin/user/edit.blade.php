<!DOCTYPE HTML>
<html>
<head>
<title>后台 --用户修改</title>
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
                <div class="forms">
                    <h3 class="title1">用户管理</h3>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                        <div class="form-title">
                            <h4>用户修改 :</h4>
                        </div>
                        <div class="form-body">
                          <form action="/admin/user/update" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="uid" value="{{$data->uid}}">
                            <div class="form-group">
                              <label for="uname">用户名</label>
                              <input type="text" class="form-control" value="{{ $data->uname }}" name="uname" id="uname" placeholder="用户名">
                            </div>
                            <div class="form-group">
                              <label for="email">邮箱</label>
                              <input type="email" class="form-control" value="{{$data->email}}" name="email" id="email" placeholder="邮箱">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">头像</label>
                                <br>
                                <img src="/uploads/{{$data->uface}}" class="img-rounded" style="width:100px;">
                                <input type="file"  class="form-control" name="uface" id="exampleInputFile">
                                <input type="hidden" name="uface_path" value="{{$data->uface}}">
                          </div>
                           <button type="submit" class="btn btn-default">提交</button>
                        </form>
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