<style>
  .login{
      float:right;
      /*margin-right: 10px;*/
      font-size: 16px;
  }
  .login img{
    margin: 15px 5px 0px;
    float: left;
    border-radius: 50%;
    /*line-height: 80px;*/
  }
  .nav .login div{
    /*line-height: 10px;*/
    width: 190px;

  }
  .nav .login span{
    display: block;
    float: right;
    line-height: 50px;
    color: #ccc;
    height: 30px;
  }
  span a{
    color: #ccc;
  }

  a:link{
    text-decoration: none;
  }

  .login a:visited{
    color: #ccc;
  }

  .menu h1{
      height: 80px;
      line-height: 80px;
      /*width: 100%;*/
      background-color: #000;
  }
  .menu li a:hover{
      text-decoration: none;
      color: #00A7EB;
      background-color: #000;
  }
</style>


<header> 
  <!-- 大模板菜单栏 开始 -->
  <div class="menu">
    <nav class="nav" id="topnav">
      <h1 class="logo"><a href="/home/index/index">个人博客</a></h1>
      <li><a href="/">网站首页</a> </li>
      <li><a href="javascript:;">关于我</a> </li>
      @foreach($data_cates as $cate)
      <li><a href="/home/list/index?cid={{$cate->cid}}">{{$cate->cname}}</a>
        <ul class="sub-nav">
          @foreach($cate->sub as $sub)
          <li><a href="/home/list/index?cid={{$sub->cid}}">{{$sub->cname}}</a></li>
          @endforeach
        </ul>
      </li>
      @endforeach

      <!-- 登录 开始 -->
      <div class="login" >
        @if(empty(session('flag_home')))
        <div>
          <div class="color">
            <a href="/home/login/index">登录</a>
            <a href="javascript:;" class="register">注册</a>
          </div>
        </div>
        @else
          @if(session('user_home')->type == 1)
          <div>
            <span>
              @if(!empty(session('user_home')->uface))
              <img src="uploads/{{session('user_home')->uface}}" width="50px">
              @endif
              <span>当前用户: <b style="color: gold;">{{session('user_home')->uname}}</b></span>
            </span>
            <!-- <br> -->
            <span>
              <a href="admins">后台管理 </a>&nbsp;&nbsp;
              <a href="/home/login/logout" class="logout"> 退出</a>
            </span>
          </div>
          @else
          <div>
            <span>
              @if(!empty(session('user_home')->uface))
              <img src="/uploads/{{session('user_home')->uface}}" class="img-circle" width="50px">
              @endif
              <span>当前用户: <b style="color: gold;">{{session('user_home')->uname}}</b></span>
            </span>
            <!-- <br> -->
            <span>
              <a href="/home/index/edit/{{session('user_home')->uid}}/{{session('user_home')->token}}">个人信息 </a>&nbsp;
              <a href="javascript:;" class="logout"> 退出</a>
            </span>
          </div>
          @endif
        @endif

        <script>
          // 退出登录
          $(".logout").click(function(){
              if (!window.confirm("确定退出?")) {
                  return false;
              }
              $.get('/home/login/logout', function(msg) {
                  if (msg == 'ok') {
                    alert('退出成功');
                    history.go(0)
                    // location.href = '/';
                  }
              });
          });

        </script>

      </div>
      <!-- 登录 结束 -->

      <!-- 搜索 开始 -->
      <div id="search_bar" class="search_bar">
        <form  id="searchform" action="/home/list/index" method="get" name="searchform">
          <input class="input" placeholder="想搜点什么呢..." type="text" name="search" id="keyboard">
          <!-- <input type="hidden" name="show" value="title" /> -->
          <!-- <input type="hidden" name="tempid" value="1" /> -->
          <!-- <input type="hidden" name="tbname" value="news"> -->
          <input type="hidden" value="搜索" />
          <span class="search_ico"></span>
        </form>
      </div>
      <!-- 搜索 结束 --> 
    </nav>
  </div>
  <!-- 大模板菜单栏 结束 -->

  <script>
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;
      
    });

    // 注册
    $(".register").click(function() {
      $('#myModal').modal('show')

      $('#myModal form input[type=text]').eq(0).blur(function() {
        let uname = $('#myModal form input[type=text]').eq(0).val();
        $.post('/home/login/store', {uname:uname}, function(msg) {
          if (msg.res == 'error_name') {
            $('.s1').text('*'+msg.info);
          } else {
            $('.s1').text('');
          }
        },'json');
      });


      $('#myModal form').submit(function() {
        let uname = $('#myModal form input[type=text]').eq(0).val();
        let upwd = $('#myModal form input[type=password]').eq(0).val();
        let repwd = $('#myModal form input[type=password]').eq(1).val();
        let code = $('#myModal form input[type=captcha]').eq(0).val();
        uname = $.trim(uname);
        let reguname = /^.{1,24}$/;
        uname = $.trim(uname);
        let regupwd = /^\w{6,12}$/;
        repwd = $.trim(repwd);
        code = $.trim(code);
        // console.log(uname,upwd,repwd)
        // return false

        // console.log('asd')        
        if(uname== "" || (uname != "" && !reguname.test(uname))){
            layer.msg(" 用户名不能为空,最多12个中文或24个字符");
            return false;
        }
        
        if(upwd== "" || (upwd != "" && !regupwd.test(upwd))){
            layer.msg(" 密码不能为空,字母、数字、下划线(6~12)");
            return false;
        }
        if(upwd != repwd){
            layer.msg(" 两次的密码不一致");
            return false;
        }
        if(code == ''){
            layer.msg(" 验证码不能为空");
            return false;
        }
        $.post('/home/login/store', {uname:uname,upwd:upwd,code:code}, function(msg) {
          if (msg.res == 'error') {
            layer.msg(msg.info);
          } else {
            // this.reset();
            // $('#myModal').modal('hide')
            self.location = '/';
            layer.msg(msg.info);
          }
        },'json');
      });
    });
    $('#myModal').on('hidden.bs.modal', function () {
        $('#myModal form').reset();
    });
    
    // $('#myModal').on('hidden.bs.modal', function (){
    //   $(this).removeData("bs.modal"); 
    // });
//     $("#myModal").on("hidden", function() {  
//   $(this).removeData("modal");  
// }); 
//     $("#myModal").on("hidden.bs.modal", function() {  
//   $(this).removeData("bs.modal"); 
// });
    
  </script>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">用户注册</h4>
          <span class="s1" style="color: red;position: absolute;left: 45%;"></span>
        </div>
        <div class="modal-body">
          <form action="javascript:;" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="uname">用户名</label>
              <input type="text" class="form-control" id="uname" name="uname" placeholder="用户名">
            </div>
            <div class="form-group">
              <label for="upwd">密码</label>
              <input type="password" class="form-control" id="upwd" name="upwd" placeholder="密码">
            </div>
            <div class="form-group">
              <label for="repwd">确认密码</label>
              <input type="password" class="form-control" id="repwd" name="repwd" placeholder="确认密码">
            </div>
            <div class="form-group">
                <label for="code">验证码</label>
                <div class="form-group">
                <input type="captcha" class="form-control" id="code" name="code" placeholder="验证码" style="width: 50%;float: left;margin-right: 20px;">
                <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
                </div>

            </div>
            <button type="submit" class="btn btn-success">提交</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel1">留言</h4>
          </div>
          <div class="modal-body">
            <form action="javascript:;" method="get">
              <textarea class="form-control" rows="10"></textarea>
              <br>
              <button type="submit" class="btn btn-success">提交</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  

    <!--小模板菜单栏 开始 -->
  <div id="mnav">
    <h2><a href="/" class="mlogo">个人博客</a><span class="navicon"></span></h2>
    @if(empty(session('flag_home')))
    <div class="login mlogo" style="position: fixed;top:0px; right: 10%;">
      <a class="mlogo" href="/home/login/index">登录</a>
    </div>
    @else
    <div class="login mlogo" style="position: fixed;top:0px; right: 10%;">
      <a class="mlogo logout" href="/home/login/index">退出</a>
    </div>
    @endif
    <dl class="list_dl">
      <dt class="list_dt"> <a href="/">网站首页</a> </dt>
      <dt class="list_dt"> <a href="/">关于我</a> </dt>
      @foreach($data_cates as $cate)
      <dt class="list_dt"> <a href="/home/list/index?cid={{$cate->cid}}">{{$cate->cname}}</a> </dt>
      <dd class="list_dd">
        <ul>
          @foreach($cate->sub as $sub)
          <li><a href="/home/list/index?cid={{$sub->cid}}">{{$sub->cname}}</a></li>
          @endforeach
        </ul>
      </dd>
      @endforeach
    </dl>
  </div>
  <!--小模板菜单栏 结束 --> 
</header>