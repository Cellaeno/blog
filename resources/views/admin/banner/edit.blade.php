<!DOCTYPE HTML>
<html>
<head>
<title>后台 --轮播图修改</title>
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
                    <h3 class="title1">轮播图管理</h3>
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
                          <h4>添加轮播图 :</h4></div>
                        <div class="form-body">
                          <form action="/admin/banner/update" method="post" enctype="multipart/form-data" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">轮播图的标题</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $datas->title }}" name="title" id="title" placeholder="标题"></div>
                            </div>
                            <div class="form-group">
                              <label for="desc" class="col-sm-2 control-label">轮播图的描述</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="desc" name="desc" value="{{$datas->desc}}" placeholder="描述"></div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-2 control-label">轮播图URL</label>
                                <div class="col-sm-9">
                                    <img src="/uploads/{{$datas->url}}" width="150px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-2 control-label"></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="url" name="url">
                                    <input type="hidden" name="url_path" value="{{$datas->url}}">
                                    <input type="hidden" name="bid" value="{{$datas->bid}}">
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="radio" class="col-sm-2 control-label">轮播图状态</label>
                                    <div class="col-sm-8">
                                        <div class="radio-inline"><label><input type="radio" {{$datas->status?'checked':''}} name="status" value="1"> 开启</label></div>
                                        <div class="radio-inline"><label><input type="radio" {{$datas->status?'':'checked'}} name="status" value="0"> 关闭</label></div>
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