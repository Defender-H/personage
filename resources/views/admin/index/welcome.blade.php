@extends('admin.base.base')
@section('content')
    <!-- 主体内容 -->
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li class="active"><a href="#">首页</a></li>
</ol>

<h4 class="page-title">仪表盘</h4>

<!-- Shortcuts -->
<div class="block-area shortcut-area">
    <a class="shortcut tile" href="">
        <img src="{{asset('admin/SuperAdmin_bootstrap/img/shortcuts/money.png')}}" alt="">
        <small class="t-overflow">进货</small>
    </a>
    <a class="shortcut tile" href="">
        <img src="{{asset('admin/SuperAdmin_bootstrap/img/shortcuts/twitter.png')}}" alt="">
        <small class="t-overflow">微博</small>
    </a>
    <a class="shortcut tile" href="">
        <img src="{{asset('admin/SuperAdmin_bootstrap/img/shortcuts/calendar.png')}}" alt="">
        <small class="t-overflow">日历</small>
    </a>
    <a class="shortcut tile" href="">
        <img src="{{asset('admin/SuperAdmin_bootstrap/img/shortcuts/stats.png')}}" alt="">
        <small class="t-overflow">统计数据</small>
    </a>
    <a class="shortcut tile" href="">
        <img src="{{asset('admin/SuperAdmin_bootstrap/img/shortcuts/connections.png')}}" alt="">
        <small class="t-overflow">连接</small>
    </a>
    <a class="shortcut tile" href="">
        <img src="{{asset('admin/SuperAdmin_bootstrap/img/shortcuts/reports.png')}}" alt="">
        <small class="t-overflow">报告</small>
    </a>
</div>

<hr class="whiter" />

<!-- Quick Stats -->
<div class="block-area">
    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats">
                <div id="stats-line-2" class="pull-left"></div>
                <div class="data">
                    <h2 data-value="98">0</h2>
                    <small>今天的票</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats media">
                <div id="stats-line-3" class="pull-left"></div>
                <div class="media-body">
                    <h2 data-value="1452">0</h2>
                    <small>今日发货</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats media">

                <div id="stats-line-4" class="pull-left"></div>

                <div class="media-body">
                    <h2 data-value="4896">0</h2>
                    <small>今天的订单</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats media">
                <div id="stats-line" class="pull-left"></div>
                <div class="media-body">
                    <h2 data-value="29356">0</h2>
                    <small>今天网站访问</small>
                </div>
            </div>
        </div>

    </div>

</div>

<hr class="whiter" />

<!-- Main Widgets -->

<div class="block-area">
    <div class="row">
        <div class="col-md-8">
            <!-- Main Chart -->
            <div class="tile">
                <h2 class="tile-title">统计</h2>
                <div class="tile-config dropdown">
                    <a data-toggle="dropdown" href="" class="tile-menu"></a>
                    <ul class="dropdown-menu pull-right text-right">
                        <li><a class="tile-info-toggle" href="">图表的信息</a></li>
                        <li><a href="">刷新</a></li>
                        <li><a href="">设置</a></li>
                    </ul>
                </div>
                <div class="p-10">
                    <div id="line-chart" class="main-chart" style="height: 250px"></div>

                    <div class="chart-info">
                        <ul class="list-unstyled">
                            <li class="m-b-10">
                                总销售额 1200
                                <span class="pull-right text-muted t-s-0"><i class="fa fa-chevron-up"></i>+12%</span>
                            </li>
                            <li>
                                <small>
                                    国内销售额 640
                                    <span class="pull-right text-muted t-s-0"><i class="fa m-l-15 fa-chevron-down"></i>-8%</span>
                                </small>
                                <div class="progress progress-small">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                </div>
                            </li>
                            <li>
                                <small>
                                    国外销售额 560
                                    <span class="pull-right text-muted t-s-0"><i class="fa m-l-15 fa-chevron-up"></i>-3%</span>
                                </small>
                                <div class="progress progress-small">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Pies 饼状图-->
            <div class="tile text-center">
                <div class="tile-dark p-10">
                    <div class="pie-chart-tiny" data-percent="86">
                        <span class="percent"></span>
                        <span class="pie-title">新访客<i class="m-l-5 fa fa-retweet"></i></span>
                    </div>
                    <div class="pie-chart-tiny" data-percent="23">
                        <span class="percent"></span>
                        <span class="pie-title">跳出率<i class="m-l-5 fa fa-retweet"></i></span>
                    </div>
                    <div class="pie-chart-tiny" data-percent="57">
                        <span class="percent"></span>
                        <span class="pie-title">电子邮件发送<i class="m-l-5 fa fa-retweet"></i></span>
                    </div>
                    <div class="pie-chart-tiny" data-percent="34">
                        <span class="percent"></span>
                        <span class="pie-title">销售的速度<i class="m-l-5 fa fa-retweet"></i></span>
                    </div>
                    <div class="pie-chart-tiny" data-percent="81">
                        <span class="percent"></span>
                        <span class="pie-title">新注册<i class="m-l-5 fa fa-retweet"></i></span>
                    </div>
                </div>
            </div>

            <!--  Recent Postings 最近的帖子-->
            <div class="row">
                <div class="col-md-6">
                    <div class="tile">
                        <h2 class="tile-title">最近的帖子</h2>
                        <div class="tile-config dropdown">
                            <a data-toggle="dropdown" href="" class="tile-menu"></a>
                            <ul class="dropdown-menu animated pull-right text-right">
                                <li><a href="">刷新</a></li>
                                <li><a href="">设置</a></li>
                            </ul>
                        </div>

                        <div class="listview narrow">
                            <div class="media p-l-5">
                                <div class="pull-left">
                                    <img width="40" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/1.jpg')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">2小时前，阿德里安桑</small><br/>
                                    <a class="t-overflow" href="">Cras molestie fermentum nibh, ac semper</a>

                                </div>
                            </div>
                            <div class="media p-l-5">
                                <div class="pull-left">
                                    <img width="40" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/2.jpg')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">5小时前，David Villa</small><br/>
                                    <a class="t-overflow" href="">Suspendisse in purus ut nibh placerat</a>

                                </div>
                            </div>
                            <div class="media p-l-5">
                                <div class="pull-left">
                                    <img width="40" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/3.jpg')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">2013年12月15日，Mitch bradberry</small><br/>
                                    <a class="t-overflow" href="">Cras pulvinar euismod nunc quis gravida. Suspendisse pharetra</a>

                                </div>
                            </div>
                            <div class="media p-l-5">
                                <div class="pull-left">
                                    <img width="40" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/4.jpg')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">2013年12月14日，Mitch bradberry</small><br/>
                                    <a class="t-overflow" href="">Cras pulvinar euismod nunc quis gravida. </a>

                                </div>
                            </div>
                            <div class="media p-l-5">
                                <div class="pull-left">
                                    <img width="40" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/5.jpg')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">2013年12月13日，Mitch bradberry</small><br/>
                                    <a class="t-overflow" href="">Integer a eros dapibus, vehicula quam accumsan, tincidunt purus</a>

                                </div>
                            </div>
                            <div class="media p-5 text-center l-100">
                                <a href=""><small>显示全部</small></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tasks to do 未完成的任务-->
                <div class="col-md-6">
                    <div class="tile">
                        <h2 class="tile-title">未完成的任务</h2>
                        <div class="tile-config dropdown">
                            <a data-toggle="dropdown" href="" class="tile-menu"></a>
                            <ul class="dropdown-menu pull-right text-right">
                                <li id="todo-add"><a href="">添加</a></li>
                                <li id="todo-refresh"><a href="">刷新</a></li>
                                <li id="todo-clear"><a href="">清除所有</a></li>
                            </ul>
                        </div>

                        <div class="listview todo-list sortable">
                            <div class="media">
                                <div class="checkbox m-0">
                                    <label class="t-overflow">
                                        <input type="checkbox">
                                        Curabitur quis nisi ut nunc gravida suscipis
                                    </label>
                                </div>
                            </div>
                            <div class="media">
                                <div class="checkbox m-0">
                                    <label class="t-overflow">
                                        <input type="checkbox">
                                        Suscipit at feugiat dewoo
                                    </label>
                                </div>

                            </div>
                            <div class="media">
                                <div class="checkbox m-0">
                                    <label class="t-overflow">
                                        <input type="checkbox">
                                        Gravida wendy lorem ipsum seen
                                    </label>
                                </div>

                            </div>
                            <div class="media">
                                <div class="checkbox m-0">
                                    <label class="t-overflow">
                                        <input type="checkbox">
                                        Fedrix quis nisi ut nunc gravida suscipit at feugiat purus
                                    </label>
                                </div>

                            </div>
                        </div>

                        <h2 class="tile-title">已完成的任务</h2>

                        <div class="listview todo-list sortable">
                            <div class="media">
                                <div class="checkbox m-0">
                                    <label class="t-overflow">
                                        <input type="checkbox" checked="checked">
                                        Motor susbect win latictals bin the woodat cool
                                    </label>
                                </div>

                            </div>
                            <div class="media">
                                <div class="checkbox m-0">
                                    <label class="t-overflow">
                                        <input type="checkbox" checked="checked">
                                        Wendy mitchel susbect win latictals bin the woodat cool
                                    </label>
                                </div>

                            </div>
                            <div class="media">
                                <div class="checkbox m-0">
                                    <label class="t-overflow">
                                        <input type="checkbox" checked="checked">
                                        Latictals bin the woodat cool for the win
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-4">
            <!-- USA Map 美国地图-->
            <div class="tile">
                <h2 class="tile-title">现场访问</h2>
                <div class="tile-config dropdown">
                    <a data-toggle="dropdown" href="" class="tile-menu"></a>
                    <ul class="dropdown-menu pull-right text-right">
                        <li><a href="">刷新</a></li>
                        <li><a href="">设置</a></li>
                    </ul>
                </div>

                <div id="usa-map"></div>
            </div>

            <!-- Dynamic Chart 动态图-->
            <div class="tile">
                <h2 class="tile-title">服务器进程</h2>
                <div class="tile-config dropdown">
                    <a data-toggle="dropdown" href="" class="tile-menu"></a>
                    <ul class="dropdown-menu pull-right text-right">
                        <li><a href="">刷新</a></li>
                        <li><a href="">设置</a></li>
                    </ul>
                </div>

                <div class="p-t-10 p-r-5 p-b-5">
                    <div id="dynamic-chart" style="height: 200px"></div>
                </div>

            </div>

            <!-- Activity 活动-->
            <div class="tile">
                <h2 class="tile-title">社交媒体活动</h2>
                <div class="tile-config dropdown">
                    <a data-toggle="dropdown" href="" class="tile-menu"></a>
                    <ul class="dropdown-menu pull-right text-right">
                        <li><a href="">刷新</a></li>
                        <li><a href="">设置</a></li>
                    </ul>
                </div>

                <div class="listview narrow">

                    <div class="media">
                        <div class="pull-right">
                            <div class="counts">367892</div>
                        </div>
                        <div class="media-body">
                            <h6>FACEBOOK的喜欢</h6>
                        </div>
                    </div>

                    <div class="media">
                        <div class="pull-right">
                            <div class="counts">2012</div>
                        </div>
                        <div class="media-body">
                            <h6>谷歌1s +</h6>
                        </div>
                    </div>

                    <div class="media">
                        <div class="pull-right">
                            <div class="counts">56312</div>
                        </div>
                        <div class="media-body">
                            <h6>YOUTUBE的观点</h6>
                        </div>
                    </div>

                    <div class="media">
                        <div class="pull-right">
                            <div class="counts">785879</div>
                        </div>
                        <div class="media-body">
                            <h6>TWITTER的追随者</h6>
                        </div>
                    </div>
                    <div class="media">
                        <div class="pull-right">
                            <div class="counts">68</div>
                        </div>
                        <div class="media-body">
                            <h6>网站的评论</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- Chat -->
<div class="chat">

    <!-- Chat List -->
    <div class="pull-left chat-list">
        <div class="listview narrow">
            <div class="media">
                <img class="pull-left" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/1.jpg')}}" width="30" alt="">
                <div class="media-body p-t-5">
                    Alex Bendit
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/2.jpg')}}" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">David Volla Watkinson</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/3.jpg')}}" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Mitchell Christein</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/4.jpg')}}" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Wayne Parnell</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/5.jpg')}}" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Melina April</span>
                </div>
            </div>
            <div class="media">
                <img class="pull-left" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/6.jpg')}}" width="30" alt="">
                <div class="media-body">
                    <span class="t-overflow p-t-5">Ford Harnson</span>
                </div>
            </div>

        </div>
    </div>

    <!-- Chat Area -->
    <div class="media-body">
        <div class="chat-header">
            <a class="btn btn-sm" href="">
                <i class="fa fa-circle-o status m-r-5"></i> Chat with Friends
            </a>
        </div>

        <div class="chat-body">
            <div class="media">
                <img class="pull-right" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/1.jpg')}}" width="30" alt="" />
                <div class="media-body pull-right">
                    Hiiii<br/>
                    How you doing bro?
                    <small>Me - 10 Mins ago</small>
                </div>
            </div>

            <div class="media pull-left">
                <img class="pull-left" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/2.jpg')}}" width="30" alt="" />
                <div class="media-body">
                    I'm doing well buddy. <br/>How do you do?
                    <small>David - 9 Mins ago</small>
                </div>
            </div>

            <div class="media pull-right">
                <img class="pull-right" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/2.jpg')}}" width="30" alt="" />
                <div class="media-body">
                    I'm Fine bro <br/>Thank you for asking
                    <small>Me - 8 Mins ago</small>
                </div>
            </div>

            <div class="media pull-right">
                <img class="pull-right" src="{{asset('admin/SuperAdmin_bootstrap/img/profile-pics/2.jpg')}}" width="30" alt="" />
                <div class="media-body">
                    Any idea for a hangout?
                    <small>Me - 8 Mins ago</small>
                </div>
            </div>

        </div>

        <div class="chat-footer media">
            <i class="chat-list-toggle pull-left fa fa-bars"></i>
            <i class="pull-right fa fa-picture-o"></i>
            <div class="media-body">
                <textarea class="form-control" placeholder="Type something..."></textarea>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
@endsection