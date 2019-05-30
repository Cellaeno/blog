<!DOCTYPE HTML>
<html>
<head>
<title>后台 --文章修改</title>
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
                    <h3 class="title1">文章管理</h3>
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
                        <h4>文章添加 :</h4>
                        </div>
                        <div class="form-body">
                            <form action="/admin/art/update" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="title">标题</label>
                                    <input type="text" class="form-control" name="title" value="{{$data->title}}" id="title" placeholder="标题">
                                </div>
                                <div class="form-group">
                                    <label for="auth">作者</label>
                                    <input type="text" class="form-control" value="{{$data->auth}}" name="auth" id="auth">
                                </div>
                                <div class="form-group">
                                    <label for="desc">描述</label>
                                    <!-- <input type="text" class="form-control" name="desc" id="desc"> -->
                                    <textarea class="form-control" name="desc" id="desc" rows="5">{{$data->desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="thumb_path">缩略图</label>
                                    <br><br>
                                    @if(!empty($data->thumb))
                                    <img src="/uploads/{{$data->thumb}}" width="200px">
                                    @endif
                                    <input type="hidden" name="thumb_path" value="{{$data->thumb}}">
                                    <input type="hidden" name="aid" value="{{$data->aid}}">
                                </div>
                                <div class="form-group">
                                    <!-- <label for="thumb"></label> -->
                                    <input type="file" class="form-control" name="thumb" id="thumb">
                                </div>
                                <div class="form-group">
                                    <label for="cid">所属栏目</label>
                                    <select name="cid" class="form-control">
                                        <option>--请选择--</option>
                                        @foreach($data_cates as $data_cate)
                                            @if($data_cate->pid == 0)
                                            <option value="{{$data_cate->cid}}" {{ $data_cate->cid == $data->cid ? 'selected' : '' }} style="font-weight: 800;">{{$data_cate->cname}}</option>
                                            @else
                                            <option value="{{$data_cate->cid}}" {{ $data_cate->cid == $data->cid ? 'selected' : '' }}>{{$data_cate->cname}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tid">所属云标签</label>
                                    <select name="tid" class="form-control">
                                        <option>--请选择--</option>
                                        @foreach($data_tags as $data_tag)
                                            <option value="{{$data_tag->tid}}" {{ $data_tag->tid == $data->tid ? 'selected' : '' }}>{{$data_tag->tname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="content">内容</label>
                                    <!-- <input type="text" class="form-control" name="title" id="title" placeholder="标题"> -->
                                    <!-- 加载编辑器的容器 -->
                                    <script id="container" name="content" type="text/plain" style="height: 300px;">
                                         {!!$data->content!!}
                                    </script>
                                    <!-- 配置文件 -->
                                    <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
                                    <!-- 编辑器源码文件 -->
                                    <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
                                    <!-- 实例化编辑器 -->
                                    <script type="text/javascript">
                                        var ue = UE.getEditor('container',{
                                            toolbars: [
                                                ['fullscreen', 'source', 'undo', 'redo'],
                                                ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc','emotion']
                                            ]
                                        });
                                    </script>

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