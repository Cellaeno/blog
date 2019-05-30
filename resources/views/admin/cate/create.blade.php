<!DOCTYPE HTML>
<html>
<head>
<title>后台 --栏目创建</title>
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
                        <h4>栏目添加 :</h4>
                        </div>
                        <div class="form-body">
                            <form action="/admin/cate/store" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="cname">栏目名</label>
                                    <input type="text" class="form-control" name="cname" id="cname" placeholder="栏目名">
                                </div>
                                <div class="form-group">
                                    <label for="uname">所属栏目</label>
                                    <select name="pid" class="form-control">
                                        <option value="0">--请选择--</option>
                                        @foreach($datas as $data)
                                            @if($data->pid == 0)
                                            <option value="{{$data->cid}}" {{ $cid == $data->cid ? 'selected' : '' }} style="font-weight: 800;">{{$data->cname}}</option>
                                            @else
                                            <option value="{{$data->cid}}" disabled>{{$data->cname}}</option>
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