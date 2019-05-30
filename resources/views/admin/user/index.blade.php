<!DOCTYPE HTML>
<html>
<head>
<title>后台 --用户</title>

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
                    <div class="form-body">
                        <div data-example-id="simple-form-inline">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputName2">关键字</label>
                                    <input type="text" name="search" value="{{ $search }}" class="form-control" id="exampleInputName2" placeholder="用户名">
                                </div>
                                <button type="submit" class="btn btn-info">搜索</button>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body widget-shadow">
                        <h4>用户列表:</h4>
                        <table class="table">
                            <tr>
                              <th>id</th>
                              <th>用户名</th>
                              <th>头像</th>
                              <th>邮箱</th>
                              <th>创建时间</th>
                              <th>状态</th>
                              <th>操作</th>
                            </tr>
                            @foreach($datas as $data)
                            <tr>
                                <th>{{ $data->uid }}</th>
                                <td>{{ $data->uname }}</td>
                                @if(!$data->uface)
                                <td>点击修改添加头像</td>
                                @else
                                <td>
                                    <img src="/uploads/{{ $data->uface }}" style="width: 80px;" class="img-thumbnail">
                                </td>
                                @endif
                                @if(!$data->email)
                                <td>点击修改添加邮箱</td>
                                @else
                                <td>{{ $data->email }}</td>
                                @endif
                                <td>{{ $data->ctime }}</td>
                                @if($data->status)
                                <td><kbd style="background:#090;">已激活<kbd></td>
                                @else
                                <td><kbd>未激活<kbd></td>
                                @endif
                                <td>
                                    <a href="/admin/user/edit/{{$data->uid}}/{{$data->token}}" class="btn btn-info">修改</a>
                                    <a href="javascript:;" class="btn btn-danger" token="{{$data->token}}" onclick="del(this,{{$data->uid}})">删除</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <script>
                    function del(obj,uid) {

                        let token = $(obj).attr('token');
                        // console.log(token,uid);
                        // return false;

                        if (!window.confirm('是否确定要删除?')) {
                            return false;
                        }
                        $.get('/admin/user/destory',{uid:uid,token:token},function(res) {
                            // alert(res);

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

                <div class="page">
                    {{ $datas->appends(['search' => $search])->links() }}
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