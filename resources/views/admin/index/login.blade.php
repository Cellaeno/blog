<!DOCTYPE html>
<!-- saved from url=(0064)http://demo.sc.chinaz.com/Files/DownLoad/moban/201806/moban3007/ -->
<html lang="zxx">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Home</title>
        <!-- Meta tag Keywords -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="keywords" content="">
        <style>
            .msg{
                width:30%;
                height: 30px;
                margin: 10px auto;
                padding: 5px;
                background-color: #f7296f;
                color: #fff;
                text-align: center;
                line-height: 30px;
                font-size: 20px;
                border-radius: 5px;
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
        <!-- Meta tag Keywords -->
        <!-- css files -->
        <link rel="stylesheet" href="/login_html/style.css" type="text/css" media="all">
        <!-- Style-CSS -->
        <link rel="stylesheet" href="/login_html/fontawesome-all.css">
        <!-- Font-Awesome-Icons-CSS -->
        <!-- //css files -->
        <!-- web-fonts -->
        <link href="/login_html/css" rel="stylesheet">
        <link href="/login_html/css(1)" rel="stylesheet">
        <!-- //web-fonts -->
    </head>

    <body>
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        <!-- bg effect -->
        <div id="bg">
            <canvas width="1518" height="590"></canvas>
            <canvas width="1518" height="590"></canvas>
            <canvas width="1518" height="590"></canvas>
        </div>
        <!-- //bg effect -->
        <!-- title -->
        <h1>后 台 登 录</h1>
        <!-- //title -->
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

        <!-- content -->
        <div class="sub-main-w3">
            <form action="/admin/index/dologin" method="post">
                {{ csrf_field() }}
                <h2>Login Now</h2>
                <div class="form-style-agile">
                    <label>
                        Username
                    </label>
                    <input placeholder="Username" name="uname" type="text" value="{{ old('uname') }}" required>
                </div>
                <div class="form-style-agile">
                    <label>
                        Password
                    </label>
                    <input placeholder="Password" name="upwd" value="{{ old('upwd') }}" type="password" required>
                </div>
                <!-- checkbox -->
                <div class="wthree-text">
                    <ul>
                        <li>
                            <label class="anim">
                                <input type="checkbox" class="checkbox">
                                <span>Stay Signed In</span>
                            </label>
                        </li>
                        <li>
                            <a href="#">Forgot Password?</a>
                        </li>
                    </ul>
                </div>
                <!-- //checkbox -->
                <input type="submit" value="Log In">
            </form>
        </div>
        <!-- //content -->

        <!-- copyright -->
        <!-- <div class="footer">
            <p>Copyright © 2018.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">网页模板</a></p>
        </div> -->
        <!-- //copyright -->

        <!-- Jquery -->
        <script src="/login_html/jquery-3.3.1.min.js.下载"></script>
        <!-- //Jquery -->

        <!-- effect js -->
        <script src="/login_html/canva_moving_effect.js.下载"></script>
        <!-- //effect js -->
    </body>
</html>