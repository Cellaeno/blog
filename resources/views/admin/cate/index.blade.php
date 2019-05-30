<!DOCTYPE HTML>
<html>
<head>
<title>后台 --栏目</title>

@include('public.header')
<style>
    .page{
        position: relative;
        left: calc(50% - 50px);
    }
</style>
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
                <div class="tables">
                    <h3 class="title1">栏目管理</h3>
                    @include('public.message')
                    @if (count($errors) > 0)
                        <div class="alert alert-danger" style="margin-top: 10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-body">
                        <div data-example-id="simple-form-inline">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputName2">关键字</label>
                                    <input type="text" name="search" class="form-control" id="exampleInputName2" placeholder="栏目名">
                                </div>
                                <button type="submit" class="btn btn-info">搜索</button>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body widget-shadow">
                        <h4>栏目列表:</h4>
                        <table class="table">
                            <tr>
                              <th>id</th>
                              <th>栏目名</th>
                              <th>父级id</th>
                              <th>路径</th>
                              <th>操作</th>
                            </tr>
                            @foreach($datas as $data)
                            <tr>
                                <th>{{ $data->cid }}</th>
                                <td>{{ $data->cname }}</td>
                                <td>{{ $data->pid }}</td>
                                <td>{{ $data->path }}</td>
                                <td>
                                    <a href="/admin/cate/edit/{{$data->cid}}" class="btn btn-info">修改</a>
                                    <a href="javascript:;" class="btn btn-danger" onclick="del(this,{{$data->cid}})">删除</a>
                                    @if($data->pid == 0)
                                    <a href="/admin/cate/create?cid={{$data->cid}}" class="btn btn-info">添加子栏目</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <script>
                    function del(obj,uid) {

                        if (!window.confirm('是否确定要删除?')) {
                            return false;
                        }
                        $.get('/admin/cate/destory',{cid:cid},function(res) {

                            if (res == 'ok') {
                                $(obj).parent().parent().remove();
                            } else{
                                alert('删除失败');
                            }
                        });
                        
                    }
                </script>

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