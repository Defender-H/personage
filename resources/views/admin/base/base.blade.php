<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>后台管理系统</title>

    <!-- CSS -->
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/form.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/calendar.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/icons.css')}}" rel="stylesheet">
    <link href="{{asset('admin/SuperAdmin_bootstrap/css/generics.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body id="skin-blur-violate">
{{--头部开始--}}
<header id="header" class="media">
    @include('admin.base.adminTopBav')
</header>
{{--头部结束--}}

{{--清除浮动--}}
<div class="clearfix"></div>

<section id="main" class="p-relative" role="main">
{{--左侧导航--}}
    <aside id="sidebar">

        <!-- Sidbar Widgets -->
        <div class="side-widgets overflow">
            <!-- Profile Menu 用户菜单-->
            <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                <a href="" data-toggle="dropdown">
                    <img class="profile-pic animated" src="@if($admin_pic==null){{asset('admin/SuperAdmin_bootstrap/img/profile-pic.jpg')}}@else {{$admin_pic}} @endif" alt="">
                </a>
                <ul class="dropdown-menu profile-menu">
                    <li><a href="javascript:;" data-id="{{session('admin')['id']}}" data-content="{{$admin_pic}}" data-motto="{{$admin_motto}}" class="admin_data">设置</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                    <li><a href="/admin/login_out">退出</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                </ul>
                <h4 class="m-0" id="tou">{{session('admin')['name']}}</h4>
            </div>

            <!-- Calendar 日历-->
            <div class="s-widget m-b-25">
                <div id="sidebar-calendar"></div>
            </div>

            <!-- 座右铭 -->
            <div class="s-widget m-b-25">
                <h2 class="tile-title">
                    座右铭
                </h2>

                <div class="s-widget-body">
                    <p>
                        @if($admin_motto==null) 暂无座右铭 @else {{$admin_motto}} @endif
                    </p>
                    <div id="news-feed">
                    </div>
                </div>
            </div>

            <!-- 所拥有的权限 -->
            <div class="s-widget m-b-25">
                <h2 class="tile-title">
                    所拥有的权限
                </h2>

                <div class="s-widget-body">
                    @foreach($admin_jurisdiction as $item => $value)
                        <div class="side-border" @if($value==null) hidden @endif>
                            <small>{{$item}}</small>
                            <div class="progress progress-small">
                                <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-info" style="width: {{$value}}%  "  data-original-title="{{$value}}%">
                                    <span class="sr-only">{{$value}}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 侧边栏菜单 -->
        <ul class="list-unstyled side-menu">
            <li class="@if(strpos(url()->current(),"admin/index/welcome")) active @endif">
                <a class="sa-side-home" href="{{asset('admin/index/welcome')}}">
                    <span class="menu-item">首页</span>
                </a>
            </li>
            <li class="dropdown @if(strpos(url()->current(),"notice/column_index") || strpos(url()->current(),"notice/article_index") || strpos(url()->current(),"notice/article_adds") || strpos(url()->current(),"notice/article_edits")) active @endif">
                <a  class="sa-side-notice" href="#">
                    <span class="menu-item">公告管理</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="{{url('admin/notice/column_index')}}">公告栏目管理</a></li>
                    <li><a href="{{url('admin/notice/article_index')}}">公告文章管理</a></li>
                </ul>
            </li>

            <li class="dropdown @if(strpos(url()->current(),"member/user") || strpos(url()->current(),"member/grade") ) active @endif">
                <a  class="sa-side-typography" href="#">
                    <span class="menu-item">会员管理</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="{{url('admin/member/user')}}">会员用户管理</a></li>
                    <li><a href="{{url('admin/member/grade')}}">会员等级管理</a></li>
                </ul>
            </li>

            <li class="dropdown @if(strpos(url()->current(),"goods/category") || strpos(url()->current(),"goods/message")|| strpos(url()->current(),"goods/index") ) active @endif">
                <a  class="sa-side-typography" href="#">
                    <span class="menu-item">商品管理</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="{{url('admin/goods/index')}}">商品管理</a></li>
                </ul>
            </li>

            <li class="dropdown @if(strpos(url()->current(),"admin_jurisdiction/category") || strpos(url()->current(),"admin_jurisdiction/message")|| strpos(url()->current(),"admin_user/index") ) active @endif">
                <a  class="sa-side-typography" href="#">
                    <span class="menu-item">管理员管理</span>
                </a>
                <ul class="list-unstyled menu-item">
                    <li><a href="{{url('admin/admin_user/jurisdiction')}}">权限管理</a></li>
                    <li><a href="{{url('admin/admin_user/admin_user')}}">管理员管理</a></li>
                </ul>
            </li>
        </ul>

    </aside>
{{--左侧导航结束--}}

{{--主体内容--}}
    <section id="content" class="container">
        @section('content')
        @show
    </section>

    {{--修改用户资料--}}
    <div class="modal fade" id="admin_data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        设置
                    </h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-validation-1" action="#" id="uploadForm" enctype="multipart/form-data">
                        <div class="form-group m-b-15">
                            <p>头像</p>
                            <input type="text" value="" id="path1" hidden>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail form-control">
                                    <img src="" alt="" id="pic">
                                </div>
                                <div>
                                     <span class="btn btn-file btn-alt btn-sm">
                                         <span class="fileupload-new">选择图片</span>
                                         <span class="fileupload-exists">更换</span>
                                         <input type="file" id="avatar1" value="" name="avatar1"/>
                                    </span>
                                    <button type="button" class="btn fileupload-exists btn-sm" id="user_avatar1" onClick="return false;">上传</button>
                                    <p style="color: red">注：若要修改图片,选择图片后记得点击上传噢</p>
                                </div>
                            </div>
                            <label>座右铭</label>
                            <input type="text" class="input-sm validate[required] form-control" placeholder="请输入座右铭" id="motto">
                        </div>
                        <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-sm" id="admin_data_up" onClick="return false;">提交</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Javascript Libraries -->
<!-- jQuery -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/jquery.min.js')}}"></script> <!-- jQuery Library -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/jquery-ui.min.js')}}"></script> <!-- jQuery UI -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/jquery.easing.1.3.js')}}"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->

<!-- Bootstrap -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Charts 图表-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/charts/jquery.flot.js')}}"></script> <!-- Flot Main -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/charts/jquery.flot.time.js')}}"></script> <!-- Flot sub 浮动下标-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/charts/jquery.flot.animator.min.js')}}"></script> <!-- Flot sub 浮动下标-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/charts/jquery.flot.resize.min.js')}}"></script> <!-- Flot sub - for repaint when resizing the screen 在调整屏幕大小时重新绘制-->

<script src="{{asset('admin/SuperAdmin_bootstrap/js/sparkline.min.js')}}"></script> <!-- Sparkline - Tiny charts 小图表-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/easypiechart.js')}}"></script> <!-- EasyPieChart - Animated Pie Charts easy压电图——动画饼图-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/charts.js')}}"></script> <!-- All the above chart related functions 以上图表相关功能-->

<!-- Map 地图-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/maps/jvectormap.min.js')}}"></script> <!-- jVectorMap main library jVectorMap主要图书馆-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/maps/usa.js')}}"></script> <!-- USA Map for jVectorMap jVectorMap美国地图-->

<!--  Form Related 表单相关-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/validation/validate.min.js')}}"></script> <!-- jQuery Form Validation Library -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/validation/validationEngine.min.js')}}"></script> <!-- jQuery Form Validation Library - requirred with above js -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/select.min.js')}}"></script> <!-- Custom Select -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/chosen.min.js')}}"></script> <!-- Custom Multi Select -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/datetimepicker.min.js')}}"></script> <!-- Date & Time Picker -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/colorpicker.min.js')}}"></script> <!-- Color Picker -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/icheck.js')}}"></script> <!-- Custom Checkbox + Radio -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/autosize.min.js')}}"></script> <!-- Textare autosize -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/toggler.min.js')}}"></script> <!-- Toggler -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/input-mask.min.js')}}"></script> <!-- Input Mask -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/spinner.min.js')}}"></script> <!-- Spinner -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/slider.min.js')}}"></script> <!-- Input Slider -->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/fileupload.min.js')}}"></script> <!-- File Upload -->

<!-- UX 用户体验-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/scroll.min.js')}}"></script> <!-- Custom Scrollbar 自定义滚动条-->

<!-- Other 其他-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/calendar.min.js')}}"></script> <!-- Calendar 日历-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/feeds.min.js')}}"></script> <!-- News Feeds 新闻提要-->


<!-- All JS functions 所有js函数-->
<script src="{{asset('admin/SuperAdmin_bootstrap/js/functions.js')}}"></script>

{{--公共js函数--}}
<script src="{{asset('admin/SuperAdmin_bootstrap/js/common.js')}}"></script>
<script>
    //设置POST头部
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //上传用户头像
    $('#user_avatar1').click(function(){
        //獲取數據
        var formData = new FormData(document.getElementById("uploadForm"));
        $.ajax({
            url: '/admin/user_avatar',
            data: formData,
            type: "POST",//规定请求的类型（GET 或 POST）。
            dataType: "JSON",//预期的服务器响应的数据类型。
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.ret == 200) {
                    $('input[id="path1"]').val(data.data);
                    tipModal(data.message);
                } else {
                    tipModal(data.message);
                }
            }
        })
    })


    //触发修改用户资料模态框
    $('.admin_data').click(function(){
        $('#admin_data').modal()
        editId=$(this).data('id')
        $('#pic').attr('src',$(this).data('content'));
        $('#path1').val($(this).data('content'))
        $('#motto').val($(this).data('motto'))
    })

    $('#admin_data_up').click(function(){
        $('#admin_data').modal('hide')
        var pic = $('#path1').val();
        var motto = $('#motto').val();
        $.ajax({
            url: '/admin/admin_edit',
            data: {id:editId,pic: pic,motto:motto},
            type: "POST",//规定请求的类型（GET 或 POST）。
            dataType: "JSON",//预期的服务器响应的数据类型。
            success: function (data) {
                if (data.ret == 200) {
                    tipModal(data.message,function(){
                        location.reload();
                    }, function(){
                        location.reload();
                    })
                } else {
                    tipModal(data.message);
                }
            }
        })
    })



</script>
@section('js')
    @show
</body>
</html>
