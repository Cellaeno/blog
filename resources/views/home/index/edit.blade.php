<!DOCTYPE HTML>
<html>

<head>
  <title>个人信息修改</title>
  <!-- Meta-Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">

  <style>
      .msg{
          width:40%;
          height: 30px;
          margin: 10px auto;
          padding: 5px;
          /*background-color: #f7296f;*/
          color: #fff;
          text-align: center;
          line-height: 30px;
          font-size: 18px;
          border-radius: 5px;
      }
      body{
        background: url('/home/login_text/images/e.jpg') no-repeat center;
        /*background: url(../images/edit.jpg)no-repeat center;*/
      }
  </style>

  <script>
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!-- //Meta-Tags -->
  <!-- Stylesheets -->
  <link href="/home/login_text/css/style.css" rel='stylesheet' type='text/css' />
  <!--// Stylesheets -->
  <!--fonts-->
  <link href="//fonts.googleapis.com/css?family=Poiret+One&amp;subset=cyrillic,latin-ext" rel="stylesheet">
  <!--//fonts-->
</head>

<body>
  <h1>Personal</h1>
  <div class="w3ls-login box box--big">
    <!-- form starts here -->
    <form action="/home/index/update" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      @if(session('error'))
          <div class="msg">
              <strong>{{ session('error') }}</strong> 
          </div>
      @endif
      @if(session('success'))
          <div class="msg">
              <strong>{{ session('success') }}</strong> 
          </div>
      @endif

      <div class="agile-field-txt">
        <label> Username</label>
        <input type="text" name="uname" value="{{$data->uname}}" placeholder="Enter User Name" required="" />
        <br><br><br>
        <label> Email</label>
        <input type="text" name="email" value="{{$data->email}}" placeholder="Enter Email" required="" />
        <br><br><br>
        <label> Image</label>
        @if(!empty($data->uface))
        <img src="/uploads/{{$data->uface}}" width="80px">
        @endif
        <input type="file" name="uface" />
      </div>
        <input type="hidden" name="uid" value="{{$data->uid}}">
        <input type="hidden" name="uface_path" value="{{$data->uface}}">
        <input type="submit" value="SIGN IN">
    </form>
  </div>
  <!-- //form ends here -->
  <!--copyright-->
  <!-- <div class="copy-wthree">
    <p>© 2018 Tool Sign In Form . All Rights Reserved | Design by
      <a href="http://w3layouts.com/" target="_blank">W3layouts</a>
    </p>
  </div> -->
  <!--//copyright-->
</body>
</html>