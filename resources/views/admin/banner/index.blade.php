<!DOCTYPE HTML>
<html>
<head>
<title>后台 --轮播图</title>

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
                    <h3 class="title1">轮播图管理</h3>
                    @include('public.message')
                    <div class="form-body">
                        <div data-example-id="simple-form-inline">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputName2">关键字</label>
                                    <input type="text" name="search" class="form-control" id="exampleInputName2" placeholder="标题或描述">
                                </div>
                                <button type="submit" class="btn btn-info">搜索</button>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body widget-shadow">
                        <h4>轮播图列表:</h4>
                        <table class="table">
                            <tr>
                              <th>id</th>
                              <th>轮播图标题</th>
                              <th>图片</th>
                              <th>状态</th>
                              <th>操作</th>
                            </tr>
                            @foreach($datas as $data)
                            <tr>
                                <th>{{ $data->bid }}</th>
                                <td>{{ $data->title }}</td>
                                <td>
                                    <img src="/uploads/{{ $data->url }}" style="width: 100px;" class="img-thumbnail">
                                </td>
                                @if($data->status)
                                <td><kbd style="background:#090;">已开启<kbd></td>
                                @else
                                <td><kbd>未开启<kbd></td>
                                @endif
                                <td>
                                    <a href="/admin/banner/edit/{{$data->bid}}" class="btn btn-info">修改</a>
                                    <a href="javascript:;" class="btn btn-danger" onclick="del(this,{{$data->bid}})">删除</a>
                                    @if($data->status == 0)
                                    <a href="javascript:;" class="btn btn-info" onclick="schange({{$data->bid}},0)">开启</a>
                                    @else
                                    <a href="javascript:;" class="btn btn-info" onclick="schange({{$data->bid}},1)">关闭</a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>

                    <script>
                        function schange(bid,sta) {

                            $('#myModal form input[type=hidden]').val(bid);

                            if (sta == 1) {
                                $('#myModal form input[type=radio]').eq(0).attr('checked', 'true');

                            } else {
                                $('#myModal form input[type=radio]').eq(1).attr('checked', 'false');
                            }
                            $('#myModal').modal('show')
                        }
                    </script>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">轮播图状态</h4>
                          </div>
                          <div class="modal-body">
                            <form action="/admin/banner/schange" method="get">
                                <input type="hidden" name="bid" value="">
                                <div class="form-group">
                                    <div class="radio-inline">
                                        <label><input type="radio" name="status" value="1"> 开启</label>
                                    </div>
                                    <div class="radio-inline">
                                        <label><input type="radio" name="status" value="0"> 关闭</label>
                                    </div>
                                    <br><br>
                                    <button type="submit" class="btn btn-success">提交</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <script>
                    function del(obj,bid) {

                        if (!window.confirm('是否确定要删除?')) {
                            return false;
                        }
                        $.get('/admin/banner/destory',{bid:bid},function(res) {

                            if (res == 'ok') {
                                $(obj).parent().parent().remove();
                            } else{
                                alert('删除失败');
                            }
                        });
                        // $.get('/admin/banner/destory', {bid:bid}, function(msg) {
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