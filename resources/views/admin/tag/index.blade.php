<!DOCTYPE HTML>
<html>
<head>
<title>后台 --云标签</title>

@include('public.header')
<style>
    th,td{
         text-align: center;
    }
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        /*padding: 8px;*/
        /*line-height: 1.42857143;*/
         vertical-align: middle; 
        /*border-top: 1px solid #ddd;*/
    }
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
                    <h3 class="title1">用户管理</h3>
                    @include('public.message')
                    <div class="panel-body widget-shadow">
                        <h4>用户列表:</h4>
                        <table class="table">
                            <tr>
                              <th>id</th>
                              <th>标签名</th>
                              <th>背景色</th>
                              <th>操作</th>
                            </tr>
                            @foreach($datas as $data)
                            <tr>
                                <th>{{ $data->tid }}</th>
                                <td>{{ $data->tname }}</td>
                                <td><span style="background-color:{{$data->bgcolor}};width: 50px;display: inline-block;height: 25px;">&nbsp;&nbsp;</span></td>
                                <td>
                                    <a href="/admin/tag/edit/{{$data->tid}}" class="btn btn-info">修改</a>
                                    <a href="javascript:;" class="btn btn-danger" onclick="del(this,{{$data->tid}})">删除</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <script>
                    function del(obj,tid) {

                        if (!window.confirm('是否确定要删除?')) {
                            return false;
                        }
                        $.get('/admin/tag/destory',{tid:tid},function(res) {

                            if (res == 'ok') {
                                $(obj).parent().parent().remove();
                            } else{
                                alert('删除失败');
                            }
                        });
                        // $.get('/admin/user/delete', {uid:uid}, function(msg) {
                        //     alert(msg)
                        // });
                        
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