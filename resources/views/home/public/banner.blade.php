  <!-- 轮播图 开始 -->
 <div class="picsbox"> 
  <div class="banner">
    <div id="banner" class="fader">

      @foreach($data_banners as $banner)
      <li class="slide" ><a href="/" target="_blank"><img src="/uploads/{{$banner->url}}"><span class="imginfo">{{$banner->title}}</span></a></li>
      @endforeach

      <div class="fader_controls">
        <div class="page prev" data-target="prev">&lsaquo;</div>
        <div class="page next" data-target="next">&rsaquo;</div>
        <ul class="pager_list">
        </ul>
      </div>
    </div>
  </div>
  <!-- 轮播图 结束 -->