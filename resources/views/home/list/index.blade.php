<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>学无止境_个人博客 - 一个站在web前端设计之路的女技术员个人博客网站</title>
<!-- 头部信息 开始 -->
@include('home.public.header_info')
<!-- 头部信息 结束 -->
<body>
<!-- 头部 开始 -->
@include('home.public.header')
<!-- 头部 结束 -->

<div class="pagebg sh"></div>
<div class="container">
  <h1 class="t_nav"><span>不要轻易放弃。学习成长的路上，我们长路漫漫，只因学无止境。 </span><a href="/" class="n1">网站首页</a><a href="javascript:;" class="n2">
    @if(!empty($tid))
    {{$tag_names[$tid]}}
    @elseif(!empty($cid))
    {{$cate_names[$cid]}}
    @else
    搜索结果: {{$search}}
    @endif
  </a></h1>
  <!-- 文章列表 开始 -->
  <div class="blogsbox">

    @foreach($data_arts as $art)
      <div class="blogs" data-scroll-reveal="enter bottom over 1s" >
        <h3 class="blogtitle"><a href="/home/detail/index?aid={{$art->aid}}&cid={{$art->cid}}&tid={{$art->tid}}" target="_blank">{{$art->title}}</a></h3>
        <span class="blogpic"><a href="/home/detail/index?aid={{$art->aid}}&cid={{$art->cid}}&tid={{$art->tid}}" title=""><img src="/uploads/{{$art->thumb}}" alt=""></a></span>
        <p class="blogtext">{{$art->desc}}</p>
        <div class="bloginfo">
          <ul>
            <li class="author"><a href="javascript:;">{{$art->auth}}</a></li>
            <li class="lmname"><a href="javascript:;">{{$cate_names[$art->cid]}}</a></li>
            <li class="ctime">{{$art->ctime}}</li>
            <li class="view"><span>{{$art->view}} </span>已阅读</li>
            <li class="like">{{$art->like}}</li>
          </ul>
        </div>
      </div>
    @endforeach
    
    <div style="position:relative;left: calc(50% - 50px);">
      <!-- 分页显示 开始 -->
      @if(!empty($tid))
      {{ $data_arts->appends(['tid' => $tid])->links() }}
      @elseif(!empty($cid))
      {{ $data_arts->appends(['cid' => $cid])->links() }}
      @else
      {{ $data_arts->appends(['search'=>$search])->links() }}
      @endif
      <!-- 分页显示 结束 -->
    </div>
    
    
  </div>
  <!-- 文章列表 结束 -->

  <!-- 右边栏 开始 -->
  @include('home.public.right_box')
  <!-- 右边栏 结束 -->

</div>
<footer>
  <p>Design by <a href="http://www.yangqq.com" target="_blank">个人博客</a> <a href="/">蜀ICP备11002373号-1</a></p>
</footer>
<a href="#" class="cd-top">Top</a>
</body>
</html>
