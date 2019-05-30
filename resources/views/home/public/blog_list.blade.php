<!-- 博客列表 开始 -->

    @foreach($data_arts as $art)
    <div class="blogs" data-scroll-reveal="enter bottom over 1s" >
      <h3 class="blogtitle"><a href="/home/detail/index?aid={{$art->aid}}&cid={{$art->cid}}&tid={{$art->tid}}" target="_blank">{{$art->title}}</a></h3>
      <span class="blogpic"><a href="/home/detail/index?aid={{$art->aid}}&cid={{$art->cid}}&tid={{$art->tid}}" title=""><img src="/uploads/{{$art->thumb}}" alt=""></a></span>
      <p class="blogtext">{{$art->desc}}</p>
      <div class="bloginfo">
        <ul>
          <li class="author"><a href="javascript:;">{{$art->auth}}</a></li>
          <li class="lmname"><a href="/home/list/index?cid={{$art->cid}}">{{$cate_names[$art->cid]}}</a></li>
          <li class="ctime">{{$art->ctime}}</li>
          <li class="view"><span>{{$art->view}}</span>已阅读</li>
          <li class="like">{{$art->like}}</li>
        </ul>
      </div>
    </div>
    @endforeach
<!-- 博客列表 结束 -->
