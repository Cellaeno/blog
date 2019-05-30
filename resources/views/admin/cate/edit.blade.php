<!DOCTYPE HTML>
<html>
<head>
<title>后台 --栏目修改</title>
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
                    <h3 class="title1">栏目管理</h3>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger" style="margin-top: 10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                        <div class="form-title">
                        <h4>栏目修改 :</h4>
                        </div>
                        <div class="form-body">
                            <form action="/admin/cate/store" method="post">
                                {{ csrf_field() }}

                                <input type="hidden" name="cid" value="$data->cid">
                                <div class="form-group">
                                    <label for="cname">栏目名</label>
                                    <input type="text" class="form-control" name="cname" value="{{$data->cname}}" id="cname" placeholder="栏目名">
                                </div>
                                <div class="form-group">
                                    <label for="uname">所属栏目</label>
                                    <select name="pid" class="form-control">
                                        <option value="0">--请选择--</option>
                                        @foreach($data_all as $datas)
                                            @if($datas->pid == 0)
                                            <option value="{{$datas->cid}}" style="font-weight: 800;">{{$datas->cname}}</option>
                                            @else
                                            <option value="{{$datas->cid}}" disabled>{{$datas->cname}}</option>
                                            @endif
                                        @endforeach
                                    </select>
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