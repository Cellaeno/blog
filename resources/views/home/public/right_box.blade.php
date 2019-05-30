<!-- 右边栏 开始 -->
<div class="sidebar">
  <div class="zhuanti">
    <h2 class="hometitle">特别推荐</h2>
    <ul>
      @foreach($special_art as $art)
      <li> <i><img src="/uploads/{{$art->thumb}}"></i>
        <p>{{$art->title}}<span><a href="/home/detail/index?aid={{$art->aid}}">阅读</a></span> </p>
      </li>
      @endforeach
    </ul>
  </div>
  <div class="tuijian">
    <h2 class="hometitle">推荐文章</h2>
    <ul class="tjpic">
      <i><img src="/uploads/{{$good_art->thumb}}"></i>
      <p><a href="/home/detail/index?aid={{$good_art->aid}}">{{$good_art->title}}</a></p>
    </ul>
    <ul class="sidenews">
      @foreach($good_arts as $art)
      <li> <i><img src="/uploads/{{$art->thumb}}"></i>
        <p><a href="/home/detail/index?aid={{$art->aid}}">{{$art->title}}</a></p>
        <span>{{$art->ctime}}</span>
      </li>
      @endforeach
    </ul>
  </div>
  <div class="tuijian">
    <h2 class="hometitle">点击排行</h2>
    <ul class="tjpic">
      <i><img src="/uploads/{{$view_art->thumb}}"></i>
      <p><a href="/home/detail/index?aid={{$view_art->aid}}">{{$view_art->title}}</a></p>
    </ul>
    <ul class="sidenews">
      @foreach($view_arts as $art)
      <li>
        <i><img src="/uploads/{{$art->thumb}}"></i>
        <p><a href="/home/detail/index?aid={{$art->aid}}">{{$art->title}}</a></p>
        <span>{{$art->ctime}}</span>
      </li>
      @endforeach
    </ul>
  </div>
  <div class="cloud">
    <h2 class="hometitle">标签云</h2>
    <ul>
      @foreach($data_tags as $tag)
      <a href="/home/list/index?tid={{$tag->tid}}">{{$tag->tname}}</a>
      @endforeach
    </ul>
  </div>
  <div class="links">
    <h2 class="hometitle">友情链接</h2>
    <ul>
      <li><a href="http://192.168.7.27" target="_blank">个人博客</a></li>
      <li><a href="http://www.baidu.com" target="_blank">D设计师博客</a></li>
      <li><a href="http://www.sina.com" target="_blank">优秀个人博客</a></li>
    </ul>
  </div>
  <div class="guanzhu" id="follow-us">
    <h2 class="hometitle">关注我们 么么哒！</h2>
    <ul>
      <li class="sina"><a href="/" target="_blank"><span>新浪微博</span>个人博客</a></li>
      <li class="tencent"><a href="/" target="_blank"><span>腾讯微博</span>个人博客</a></li>
      <li class="qq"><a href="/" target="_blank"><span>QQ号</span>1609691734</a></li>
      <li class="email"><a href="/" target="_blank"><span>邮箱帐号</span>1609691734@qq.com</a></li>
      <li class="wxgzh"><a href="/" target="_blank"><span>微信号</span>18320258304</a></li>
      <li class="wx"><img src="/home/images/wx.jpg"></li>
    </ul>
  </div>
</div>
<!-- 右边栏 结束 -->
