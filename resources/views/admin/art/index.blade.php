<!DOCTYPE HTML>
<html>
<head>
<title>后台 --文章</title>

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

    .hid{
        width:100px;
        /*height: 60px;*/
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
    .modal-content{
        width: 800px;
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
                    <h3 class="title1">文章管理</h3>
                    @include('public.message')
                    <div class="form-body">
                        <div data-example-id="simple-form-inline">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputName2">关键字</label>
                                    <input type="text" name="search" value="{{$search}}" class="form-control" id="exampleInputName2" placeholder="标题/描述/内容">
                                </div>
                                <button type="submit" class="btn btn-info">搜索</button>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body widget-shadow">
                        <h4>文章列表:</h4>
                        <table class="table">
                            <tr>
                              <th>id</th>
                              <th>标题</th>
                              <th>作者</th>
                              <th>描述</th>
                              <th>缩略图</th>
                              <th>创建时间</th>
                              <th>阅读量 / 点赞数</th>
                              <th>操作</th>
                            </tr>
                            @foreach($datas as $data)
                            <tr>
                                <th>{{ $data->aid }}</th>
                                <td><p class="hid">{{ $data->title }}</p></td>
                                <td>{{ $data->auth }}</td>
                                <td><p class="hid">{{ $data->desc }}</p></td>
                                <td>
                                    @if(!empty($data->thumb))
                                    <img src="/uploads/{{ $data->thumb }}" width="100px">
                                    @endif
                                </td>
                                <td>{{ $data->ctime }}</td>
                                <td>{{ $data->view }} / {{ $data->like }}</td>
                                <td style="display: none;"><div>{{$data->content}}</div></td>
                                <td>
                                    <a href="/admin/art/edit/{{$data->aid}}" class="btn btn-info">修改</a>
                                    <a href="javascript:;" class="btn btn-danger" onclick="del(this,{{$data->aid}})">删除</a>
                                    <a href="javascript:;" class="btn btn-info" onclick="showart(this,{{$data->aid}})">查看文章内容</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <script>
                    function showart(obj,aid) {
                        let cont = $(obj).parent().prev().text();
                        let title = $(obj).parent().parent().find('td').eq(0).text();
                        $('.modal-body').html(cont);
                        $('.modal-title').html(title);
                        $('#myModal').modal('show');
                    }
                </script>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                      </div>
                      <div class="modal-body">
                        
                      </div>
                    </div>
                  </div>
                </div>


                <script>
                    function del(obj,aid) {

                        if (!window.confirm('是否确定要删除?')) {
                            return false;
                        }
                        $.get('/admin/art/destory',{aid:aid},function(res) {
                            // alert(res);

                            if (res == 'ok') {
                                $(obj).parent().parent().remove();
                            } else{
                                alert('删除失败');
                            }
                        });
                        // $.get('/admin/art/destory', {aid:aid}, function(msg) {
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