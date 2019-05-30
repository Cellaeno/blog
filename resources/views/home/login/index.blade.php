<!DOCTYPE HTML>
<html>

<head>
  <title>登录</title>
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
        background: url('/home/login_text/images/b.jpg') no-repeat center;
      }

      input[type="captcha"]{
        width: 50%;
        color: #aaa;
        outline: none;
        font-size: 15px;
        font-weight: bold;
        letter-spacing: 2px;
        letter-spacing: 3px;
        /* line-height: 25px; */
        padding: 15px;
        box-sizing: border-box;
        border: none;
        border: 1px solid #aaa;
        -webkit-appearance: none;
        font-family: 'Poiret One', cursive;
        background: transparent;
        position: absolute;
        left: 55px;
        margin-top: 10px;
        /*margin-bottom: 10px;*/
      }

      .agile-field-txt .code{
        position:relative;
        height: 40px;
        border-radius: 0px;
        border: 0px;
        top: 15px;
        left: 100px;
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
  <h1>Login Now</h1>
  <div class="w3ls-login box box--big">
    <!-- form starts here -->
    <form action="/home/login/dologin" method="post">
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
        <input type="text" name="uname" placeholder="Enter User Name" required="" />
      </div>
      <div class="agile-field-txt">
        <label> password</label>
        <input type="password" name="upwd" placeholder="Enter Password" required="" id="myInput" />
      </div>
      <div class="agile-field-txt">
        <label> Code</label>
        <br>
        <input type="captcha" name="code" placeholder="Enter Code" required=""  />
        <img class="code" src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
      </div>
      <div class="agile-field-txt" style="margin-top: 20px;">
        <div class="agile_label">
          <input id="check3" name="check3" type="checkbox" value="show password" onclick="myFunction()">
          <label class="check" for="check3">Show password</label>
        </div>
        <div class="agile-right">
          <a href="#">forgot password?</a>
        </div>
      </div>
      <!-- script for show password -->
      <script>
        function myFunction() {
          var x = document.getElementById("myInput");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
      </script>
      <!-- //end script -->
      <div class="w3ls-bot">
        <div class="switch-agileits">
          <label class="switch">
            <input type="checkbox">
            <span class="slider round"></span>
            keep me signed in
          </label>
        </div>
      </div>
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