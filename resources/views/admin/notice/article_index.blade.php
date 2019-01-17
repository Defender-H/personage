@extends('admin.base.base')
@section('content')
<!-- 主体内容 -->
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{url('/admin/index/welcome')}}">Home</a></li>
    {{--<li><a href="#">Library</a></li>--}}
    <li class="active">公告文章管理</li>
</ol>

<h4 class="page-title b-0">公告文章管理</h4>

<div class="tabbable" id="tabs-813136">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#panel-001" data-toggle="tab">全部文章</a>
        </li>
        <li>
            <a href="#panel-002" data-toggle="tab">已发布文章</a>
        </li>
        <li>
            <a href="#panel-003" data-toggle="tab">未发布文章</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="panel-001">
            <div class="listview list-container">
                <header class="listview-header media">
                    <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

                    <ul class="list-inline list-mass-actions pull-left">
                        <li>
                            <a href="{{url('admin/notice/article_adds')}}" title="添加" class="add">
                                <i class="sa-list-add"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{asset('admin/notice/article_index')}}" title="刷新" class="tooltips">
                                <i class="sa-list-refresh"></i>
                            </a>
                        </li>
                        <li class="show-on" style="display: none;">
                            <a href="" title="删除" class="tooltips">
                                <i class="sa-list-delete"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </header>
                <div class="block-area" id="tableHover">
                    <div class="table-responsive overflow">
                        <table class="table table-bordered table-hover tile">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>标题</th>
                                <th>所属栏目</th>
                                <th>简介</th>
                                <th>状态</th>
                                <th>修改时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tr @if(!$article[0]==null) hidden @endif>
                                <td>暂无数据</td>
                            </tr>
                            @foreach($article as $articles)
                                <tbody>
                                <tr>
                                    <td>{{$articles['id']}}</td>
                                    <td>{{$articles['title']}}</td>
                                    <td><?php $data = \App\Model\Notice_column::where(['id'=>$articles['column_id']])->first(); echo $data['name']?></td>
                                    <td>{{$articles['synopsis']}}</td>
                                    <td>@if($articles['status']==0)未启用@else启用@endif</td>
                                    <td>{{$articles['updated_at']}}</td>
                                    <td>
                                        <a href="{{url('admin/notice/article_status?id='.$articles['id'])}}" class="status"><i class="icon-comment"></i> @if($articles['status']==0)启用@else禁用@endif</a>
                                        <a href="{{url('admin/notice/article_edits?id='.$articles['id'])}}" data-id="{{$articles['id']}}" class="edit"><i class="icon-comment"></i> 修改</a>
                                        <a href="javascript:;" data-id="{{$articles['id']}}" class="del"><i class="icon-comment"></i> 删除</a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>

                    </div>
                </div>
                <div class="media text-center">
                    <ul class="pagination">
                        {{$article->links()}}
                    </ul>
                </div>
            </div>

            <div class="modal fade" id="del2">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                标题
                            </h4>
                        </div>
                        <input type="text" id="id2" hidden>
                        <div class="modal-body">
                            确定删除该文章？
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-sm" id="article_del" onClick="return false;">确定</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane" id="panel-002">
            <div class="listview list-container">
                <header class="listview-header media">
                    <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

                    <ul class="list-inline list-mass-actions pull-left">
                        <li>
                            <a href="{{url('admin/notice/article_adds')}}" title="添加" class="add">
                                <i class="sa-list-add"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{asset('admin/notice/column_index')}}" title="刷新" class="tooltips">
                                <i class="sa-list-refresh"></i>
                            </a>
                        </li>
                        <li class="show-on" style="display: none;">
                            <a href="" title="删除" class="tooltips">
                                <i class="sa-list-delete"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </header>
                <div class="block-area" id="tableHover">
                    <div class="table-responsive overflow">
                        <table class="table table-bordered table-hover tile">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>标题</th>
                                <th>所属栏目</th>
                                <th>简介</th>
                                <th>状态</th>
                                <th>修改时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tr @if(!$article1[0]==null) hidden @endif>
                                <td>暂无数据</td>
                            </tr>
                            @foreach($article1 as $articles)
                                <tbody>
                                <tr>
                                    <td>{{$articles['id']}}</td>
                                    <td>{{$articles['title']}}</td>
                                    <td><?php $data = \App\Model\Notice_column::where(['id'=>$articles['column_id']])->first(); echo $data['name']?></td>
                                    <td>{{$articles['synopsis']}}</td>
                                    <td>@if($articles['status']==0)未启用@else启用@endif</td>
                                    <td>{{$articles['updated_at']}}</td>
                                    <td>
                                        <a href="{{url('admin/notice/article_status?id='.$articles['id'])}}" class="status"><i class="icon-comment"></i> @if($articles['status']==0)启用@else禁用@endif</a>
                                        <a href="{{url('admin/notice/article_edits?id='.$articles['id'])}}" data-id="{{$articles['id']}}" class="edit"><i class="icon-comment"></i> 修改</a>
                                        <a href="javascript:;" data-id1="{{$articles['id']}}" class="del1"><i class="icon-comment"></i> 删除</a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>

                    </div>
                </div>
                <div class="media text-center">
                    <ul class="pagination">
                        {{$article1->links()}}
                    </ul>
                </div>
            </div>

            <div class="modal fade" id="del21">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                标题
                            </h4>
                        </div>
                        <input type="text" id="id21" hidden>
                        <div class="modal-body">
                            确定删除该文章？
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-sm" id="article_del1" onClick="return false;">确定</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane" id="panel-003">
            <div class="listview list-container">
                <header class="listview-header media">
                    <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

                    <ul class="list-inline list-mass-actions pull-left">
                        <li>
                            <a href="{{url('admin/notice/article_adds')}}" title="添加" class="add">
                                <i class="sa-list-add"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{asset('admin/notice/column_index')}}" title="刷新" class="tooltips">
                                <i class="sa-list-refresh"></i>
                            </a>
                        </li>
                        <li class="show-on" style="display: none;">
                            <a href="" title="删除" class="tooltips">
                                <i class="sa-list-delete"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </header>
                <div class="block-area" id="tableHover">
                    <div class="table-responsive overflow">
                        <table class="table table-bordered table-hover tile">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>标题</th>
                                <th>所属栏目</th>
                                <th>简介</th>
                                <th>状态</th>
                                <th>修改时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tr @if(!$article0[0]==null) hidden @endif>
                                <td>暂无数据</td>
                            </tr>
                            @foreach($article0 as $articles)
                                <tbody>
                                <tr>
                                    <td>{{$articles['id']}}</td>
                                    <td>{{$articles['title']}}</td>
                                    <td><?php $data = \App\Model\Notice_column::where(['id'=>$articles['column_id']])->first(); echo $data['name']?></td>
                                    <td>{{$articles['synopsis']}}</td>
                                    <td>@if($articles['status']==0)未启用@else启用@endif</td>
                                    <td>{{$articles['updated_at']}}</td>
                                    <td>
                                        <a href="{{url('admin/notice/article_status?id='.$articles['id'])}}" class="status"><i class="icon-comment"></i> @if($articles['status']==0)启用@else禁用@endif</a>
                                        <a href="{{url('admin/notice/article_edits?id='.$articles['id'])}}" data-id="{{$articles['id']}}" class="edit"><i class="icon-comment"></i> 修改</a>
                                        <a href="javascript:;" data-id0="{{$articles['id']}}" class="del0"><i class="icon-comment"></i> 删除</a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>

                    </div>
                </div>
                <div class="media text-center">
                    <ul class="pagination">
                        {{$article0->links()}}
                    </ul>
                </div>
            </div>

            <div class="modal fade" id="del20">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                标题
                            </h4>
                        </div>
                        <input type="text" id="id20" hidden>
                        <div class="modal-body">
                            确定删除该文章？
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-sm" id="article_del0" onClick="return false;">确定</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    //显示全部文章页面删除公告文章模态框
    $('.del').click(function () {
        $('#del2').modal()
        var id=$(this).data('id')
        $('input[id="id2"]').val(id);
    })

    //实现全部文章页面删除公告文章
    $('#article_del').click(function(){
        //獲取數據
        var id=$('#id2').val();
        $.ajax({
            url: '/admin/notice/article_del',
            data: {id: id},
            type: "POST",//规定请求的类型（GET 或 POST）。
            dataType: "JSON",//预期的服务器响应的数据类型。
            success: function (data) {
                if (data.ret == 200) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        })
    })

    //显示发布文章页面删除公告文章模态框
    $('.del1').click(function () {
        $('#del21').modal()
        var id=$(this).data('id1')
        $('input[id="id21"]').val(id);
    })

    //实现发布文章页面删除公告文章
    $('#article_del1').click(function(){
        //獲取數據
        var id=$('#id21').val();
        $.ajax({
            url: '/admin/notice/article_del',
            data: {id: id},
            type: "POST",//规定请求的类型（GET 或 POST）。
            dataType: "JSON",//预期的服务器响应的数据类型。
            success: function (data) {
                if (data.ret == 200) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        })
    })

    //显示未发布文章页面删除公告文章模态框
    $('.del0').click(function () {
        $('#del20').modal()
        var id=$(this).data('id0')
        $('input[id="id20"]').val(id);
    })

    //实现未发布文章页面删除公告文章
    $('#article_del0').click(function(){
        //獲取數據
        var id=$('#id20').val();
        $.ajax({
            url: '/admin/notice/article_del',
            data: {id: id},
            type: "POST",//规定请求的类型（GET 或 POST）。
            dataType: "JSON",//预期的服务器响应的数据类型。
            success: function (data) {
                if (data.ret == 200) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        })
    })
</script>
@endsection