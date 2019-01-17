<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>搜索</title>

    <!-- 引入样式 -->
    <link rel="stylesheet" href="https://unpkg.com/vant/lib/index.css">
</head>
<body>
{{--头部导航--}}
<div id="app">
    <form action="/">
        <van-search
                v-model="value"
                placeholder="请输入搜索关键词"
                show-action
                @search="onSearch"
                @cancel="onCancel"
        />
    </form>
</div>

</body>
<!-- 引入组件 -->
<script src="https://unpkg.com/vue/dist/vue.min.js"></script>
<script src="https://unpkg.com/vant/lib/vant.min.js"></script>
<script>
    //    头部
    new Vue({
        el: '#app',
        data(){
            return{
                value:'',
                action:0,
            }
        },
        methods:{
            onSearch(){
                alert(this.value);
            },
            onCancel(){
                history.go(-1);
            }
        }
    })
</script>
</html>