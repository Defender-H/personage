<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>后台系统登陆</title>

    <!-- CSS -->
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/form.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/generics.css')}}" rel="stylesheet">
</head>
<body id="skin-blur-violate">
<section id="login" style="position: relative; left: 35%; top: 20%">
    <header>
        <h1>后台系统登陆</h1>
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>--}}
    </header>

    <div class="clearfix"></div>
    <form class="box tile animated active" id="box-login" method="post">
        <input name="_token" value="{{csrf_token()}}" type="hidden">
        <h2 class="m-t-0 m-b-15">登陆</h2>
        <input type="text" class="login-control m-b-10" placeholder="请输入管理员账号" name="account">
        <input type="password" class="login-control" placeholder="请输入管理员密码" name="pwd">
        <div class="checkbox m-b-20">
            {{--<label>--}}
                {{--<input type="checkbox">--}}
                {{--记住账号--}}
            {{--</label>--}}
        </div>
        <div align="center">
            <button class="btn btn-sm m-r-5" style="width: 50px" onclick="return check(this.form)">登陆</button>
        </div>
        <div>
            <p style="color: red">{{$message}}</p>
        </div>
    </form>
</section>

<!-- Javascript Libraries -->
<!-- jQuery -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/jquery.min.js')}}"></script> <!-- jQuery Library -->

<!-- Bootstrap -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/bootstrap.min.js')}}"></script>

<!--  Form Related -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/icheck.js')}}"></script> <!-- Custom Checkbox + Radio -->

<!-- All JS functions -->
{{--<script src="{{asset('admin/SuperAdmin_bootstrap/js/functions.js')}}"></script>--}}

<script type="text/javascript">
    function check(form) {
        if(form.account.value=='') {
            alert("请输入用户帐号!");
            return false;
        }
        if(form.pwd.value==''){
            alert("请输入登录密码!");
            return false;
        }
        return true;
    }
</script>

</body>
</html>
