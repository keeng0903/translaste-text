
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Meta tag Keywords -->
    <!-- css files -->
    <link rel="stylesheet" href="{{asset('login/css/style.css')}}" type="text/css" media="all" /> <!-- Style-CSS -->
    <link rel="stylesheet" href="{{asset('login/css/font-awesome.css')}}"> <!-- Font-Awesome-Icons-CSS -->
    <!-- //css files -->
    <!-- online-fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <!-- //online-fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <style>
        .loader{
            width: 100%;
            height: 100%;
            background: #3a6186; /* fallback for old browsers */
            background: -webkit-linear-gradient(to left, #3a6186, #89253e); /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to left, #3a6186, #89253e); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100000000000;
            display: block;
            overflow: hidden;
        }
        .icon{
            font-size: 80px;
            color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -40px;
            margin-left: -40px;
        }
        .xoay{
            animation: xoay 1.5s linear infinite;
            -moz-animation: xoay 1.5s linear infinite;
            -ms-animation: xoay 1.5s linear infinite;
            -o-animation: xoay 1.5s linear infinite;
            -webkit-animation: xoay 1.5s linear infinite;
        }
        @-webkit-keyframes xoay{
            from{
                -ms-transform:rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to{
                -ms-transform:rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        /*@keyframes xoay{
            from{
                -ms-transform:rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to{
                -ms-transform:rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }*/

    </style>
</head>
<body class="preloading">
<!-- main -->
<div class="center-container">
    <!--header-->
    <div class="header-w3l">
        <h1>ĐĂNG NHẬP QUẢN TRỊ VIÊN</h1>
    </div>
    <!--//header-->
    <div class="main-content-agile">
        <div class="sub-main-w3">
            <div class="wthree-pro">
                <?php
                $message = Session()->get('message');
                if ($message){ ?>
                <p id="alert alert-error"><h2><?php echo $message ?></h2></p>;
                <?php  Session()->put('message',null);
                }
                ?>
            </div>
            <form action="{{route('admin.confirm')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="pom-agile">
                    <input placeholder="E-mail" name="email" class="user" type="email" required="">
                </div>
                <div class="pom-agile">
                    <input  placeholder="Password" name="password" class="pass" type="password" required="">
                </div>

                <div class="sub-w3l">
                    {{--                    <h6><a href="#">Forgot Password?</a></h6>--}}
                    <div class="right-w3l">
                        <input type="submit" name="login" value="Đăng nhập">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--//main-->
    <!--footer-->
    <div class="footer">
        {{--        <p>&copy; 2017 Online Login Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>--}}
    </div>
    <!--//footer-->
    <div class="loader">
        <span class="fas fa-spinner xoay icon"></span>
    </div>
</div>
<script type="text/javascript" src="{{asset('login/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('login/js/script.js')}}"></script>
<script>
    $(window).on('load', function(event) {
        $('body').removeClass('preloading');
        // $('.load').delay(1000).fadeOut('fast');
        $('.loader').delay(500).fadeOut('fast');
    });
</script>
</body>
</html>
