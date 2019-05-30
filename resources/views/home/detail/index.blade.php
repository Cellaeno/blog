<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>个人博客</title>
    @include('home.public.header_info')
<body>
    @include('home.public.header')
<article>
  <h1 class="t_nav"><span>您现在的位置是：首页 > {{$cate_names[$data_art->cid]}} > 文章详情</span><a href="/" class="n1">网站首页</a><a href="javascript:;" class="n2">{{$cate_names[$data_art->cid]}}</a></h1>
  <div class="infosbox">
    <div class="newsview">
      <h3 class="news_title">{{$data_art->title}}</h3>
      <div class="bloginfo">
        <ul>
          <li class="author"><a href="javascript:;">{{$data_art->auth}}</a></li>
          <li class="lmname"><a href="javascript:;">{{$cate_names[$data_art->cid]}}</a></li>
          <li class="timer">{{$data_art->ctime}}</li>
          <li class="view">{{$data_art->view}}</li>
          <li class="like">{{$data_art->like}}</li>
        </ul>
      </div>
      <div class="tags"><a href="/home/list/index?tid={{$data_art->tid}}" target="_blank">{{$tag_names[$data_art->tid]}}</a></div>
      <div class="news_about"><strong>简介</strong>{{$data_art->desc}}</div>
      <div class="news_con">
        {!!$data_art->content!!}
      </div>
    </div>

    <div class="share">
      <p class="diggit"><a href="javascript:;" onclick="good({{$data_art->aid}},this)"> 很赞哦！ </a></p>
      <p class="dasbox"><a href="javascript:void(0)" onClick="dashangToggle()" class="dashang" title="打赏，支持一下">打赏本站</a></p>
      <div class="hide_box"></div>
      <div class="shang_box"> <a class="shang_close" href="javascript:void(0)" onclick="dashangToggle()" title="关闭">关闭</a>
        <div class="shang_tit">
          <p>感谢您的支持，我会继续努力的!</p>
        </div>
        <div class="shang_payimg"> <img src="/home/images/alipayimg.jpg" alt="扫码支持" title="扫一扫"> </div>
        <div class="pay_explain">扫码打赏，你说多少就多少</div>
        <div class="shang_payselect">
          <div class="pay_item checked" data-id="alipay"> <span class="radiobox"></span> <span class="pay_logo"><img src="/home/images/alipay.jpg" alt="支付宝"></span> </div>
          <div class="pay_item" data-id="weipay"> <span class="radiobox"></span> <span class="pay_logo"><img src="/home/images/wechat.jpg" alt="微信"></span>
        </div>
    </div>

    <script>
      layui.use(['layer', 'form'], function(){
        var layer = layui.layer
        ,form = layui.form;
        
      });
      function good(aid,obj) {
          // alert(aid)

        $.get('/home/detail/like', {aid:aid}, function(res) {
          if (res.msg == 'error') {
           layer.msg(res.info)
          } else {
           layer.msg(res.info)
          }
        },'json');
      }
    </script>

    <script type="text/javascript">
        layui.use(['layer', 'form'], function(){
            var layer = layui.layer
            ,form = layui.form;
        
        });
        $(function(){
            $(".pay_item").click(function(){
                $(this).addClass('checked').siblings('.pay_item').removeClass('checked');
                var dataid=$(this).attr('data-id');
                $(".shang_payimg img").attr("src","/home/images/"+dataid+"img.jpg");
                $("#shang_pay_txt").text(dataid=="alipay"?"支付宝":"微信");
            });
        });
        function dashangToggle(){
            $(".hide_box").fadeToggle();
            $(".shang_box").fadeToggle();
        }
    </script> 
      </div>
    </div>
    <!-- 上下篇 开始 -->
    <div class="nextinfo">
        @if($prev_art)
        <p>上一篇：<a href="/home/detail/index?aid={{$prev_art->aid}}"> {{$prev_art->title}} </a></p>
        @endif

        @if($next_art)
        <p>下一篇：<a href="/home/detail/index?aid={{$next_art->aid}}"> {{$next_art->title}} </a></p>
        @endif
    </div>
    <!-- 上下篇 结束 -->

    <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        @if($like_arts)
          @foreach($like_arts as $like_art)
          <li><a href="/home/detail/index?aid={{$like_art->aid}}">{{$like_art->title}}</a></li>
          @endforeach
        @endif
      </ul>
    </div>
    <div class="news_pl">
      <h2>文章评论 <a href="javascript:;" onclick="discuss(this,{{$data_art->aid}})" style="color: #000;"> 点击留言</a></h2>
      <br>
      <h4><b>留言信息</b></h4>
      <table width="100%">
        @foreach($data_discusses as $discuss)
        <tr align="center" valign="center"  height="60px">
          <th style="width: 50px;">
            @if(!empty($discuss->sub->uface))
            <img src="/uploads/{{$discuss->sub->uface}}" width="35px" class="img-rounded">
            @endif
          </th>
          <th>{{$discuss->sub->uname}}</th>
          <td>{{$discuss->content}}</td>
        </tr>
        @endforeach
      </table>
    </div>
    <script>
      function discuss(obj,aid) {
        // alert(aid)
        $.get('/home/detail/discuss', function(res) {
          if (res.res == 'error_user') {
              layer.msg(res.info);
            }
        },'json');

        $('#myModal1').modal('show')
        // let content = $('#myModal1 form textarea').text('asdfghjk');
        $('#myModal1 form').submit(function() {
          let content = $('#myModal1 form textarea').val();
          content = $.trim(content);
          if (content == '') {
            layer.msg('评论不能为空');
            return false;
          }
          // alert($);
          $.get('/home/detail/discuss', {aid:aid,content:content}, function(msg) {
            if (msg.res == 'error') {
              layer.msg(msg.info);
            } else {
              layer.msg(msg.info)
              history.go(0);
            }
          },'json');
        });
      }
    </script>
  </div>
  
  @include('home.public.right_box')

</article>

<footer>

</footer>
<a href="#" class="cd-top">Top</a>
</body>
</html>
