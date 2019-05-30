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
                    <h3 class="title1">留言管理</h3>
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
                    <!-- <div class="form-body">
                        <div data-example-id="simple-form-inline">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputName2">关键字</label>
                                    <input type="text" name="search" class="form-control" id="exampleInputName2" placeholder="栏目名">
                                </div>
                                <button type="submit" class="btn btn-info">搜索</button>
                            </form>
                        </div>
                    </div> -->
                    <div class="panel-body widget-shadow">
                        <h4>留言列表:</h4>
                        <table class="table">
                            <tr>
                              <th>id</th>
                              <th>留言者</th>
                              <th>文章标题</th>
                              <th>评论内容</th>
                              <th>创将时间</th>
                              <th>操作</th>
                            </tr>
                            @foreach($datas as $data)
                            <tr>
                                <th>{{ $data->did }}</th>
                                <td>{{ $user_names[$data->uid] }}</td>
                                <td>{{ $art_titles[$data->aid] }}</td>
                                <td>{{ $data->content }}</td>
                                <td>{{ $data->ctime }}</td>
                                <td>
                                    <a href="javascript:;" class="btn btn-danger" onclick="del(this,{{$data->did}})">删除</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <script>
                    function del(obj,did) {

                        if (!window.confirm('是否确定要删除?')) {
                            return false;
                        }
                        $.get('/admin/discuss/destory',{did:did},function(res) {

                            if (res == 'ok') {
                                $(obj).parent().parent().remove();
                            } else{
                                alert('删除失败');
                            }
                            // alert(res)
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