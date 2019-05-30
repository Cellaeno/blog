<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>首页_个人博客</title>
    
    <!-- 头部信息 开始 -->
    @include('home.public.header_info')
    <!-- 头部信息 结束 -->


    <!-- 头部 开始 -->
    @include('home.public.header')
    <!-- 头部 结束 -->


<article> 
  <!-- 轮播图 开始 -->
  @include('home.public.banner')
  <!-- 轮播图 结束 -->

  <!-- 顶部图片 开始 -->
  @include('home.public.top_pic')
  <!-- 顶部图片 结束 -->

  <!-- 博客列表 开始 -->
  <div class="blogsbox">
  @include('home.public.blog_list')
  </div>
  <!-- 博客列表 结束 -->

  <!-- 右边栏 开始 -->
  @include('home.public.right_box')
  <!-- 右边栏 结束 -->
</article>
<!-- 页脚 开始 -->
@include('home.public.footer')
<!-- 页脚 结束 -->
<a href="#" class="cd-top">Top</a>
</body>
</html>
