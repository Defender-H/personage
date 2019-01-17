<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>个人商城</title>

    <!-- 引入样式 -->
    <link rel="stylesheet" href="https://unpkg.com/vant/lib/index.css">
</head>
<body>

@section('content')
@show

{{--底部导航--}}
<div id="bottom">
    <van-tabbar v-model="active">
        <van-tabbar-item icon="wap-home" url="/mobile/home/index" >首页</van-tabbar-item>
        <van-tabbar-item icon="wap-nav" url="/mobile/classify/index" >分类</van-tabbar-item>
        <van-tabbar-item icon="contact" url="/mobile/user/index" >个人</van-tabbar-item>
    </van-tabbar>
</div>

<!-- 引入组件 -->
<script src="https://unpkg.com/vue/dist/vue.min.js"></script>
<script src="https://unpkg.com/vant/lib/vant.min.js"></script>

@section('js')
@show

<script>
    //底部
    bottom = new Vue({
        el: '#bottom',
        data: {
            active: '',
        },
        methods:{
            aa(){
                var url = window.location.href;
                if(url.indexOf("/home/") >= 0 ) { //判断url地址中是否包含link字符串
                    this.active=0;
                }
                if(url.indexOf("/classify/") >= 0 ) { //判断url地址中是否包含link字符串
                    this.active=1;
                }
                if(url.indexOf("/user/") >= 0 ) { //判断url地址中是否包含link字符串
                    this.active=2;
                }
            }
        }
    })

    bottom.aa();
</script>
</body>
</html>
