@extends('admin.base.base')
@section('content')
        <!-- 主体内容 -->
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{url('/admin/index/welcome')}}">Home</a></li>
    <li class="active">商品管理</li>
</ol>

<h4 class="page-title b-0">商品管理</h4>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="tabbable" id="tabs-934076">
                <ul class="nav nav-pills nav-stacked" style="width: 10%; height: 100%; float: left">
                    @foreach($category as $categorys)
                    <li class="@if($category[0]['id']==$categorys['id']) active @endif" style="background-color: #6610f2">
                        <a href="#panel-{{$categorys['id']}}" data-toggle="tab">{{$categorys['name']}}
                            <button onclick="category_edit({{$categorys['id']}})" style="background-color: #1d2124; float: right">修改</button>
                        </a>
                    </li>
                    @endforeach
                    <li style="background-color: #8a6d3b">
                        <a href="#panel-999999991" data-toggle="tab">已上架商品</a>
                    </li>
                    <li style="background-color: #8a6d3b">
                        <a href="#panel-999999992" data-toggle="tab">已下架商品</a>
                    </li>
                    <li style="background-color: #8a6d3b">
                            <a href="#panel-999999993" data-toggle="tab">缺货商品</a>
                    </li>
                    <li style="background-color: red">
                        <a data-toggle="modal" href="#modalNarrower" class="tooltips">
                            新建分类
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    @foreach($category as $v)
                    <div class="tab-pane @if($category[0]['id']==$v['id']) active @endif" id="panel-{{$v['id']}}" style="width:85%; float: right">
                        <div class="listview list-container">
                            <header class="listview-header media">
                                <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

                                <ul class="list-inline list-mass-actions pull-left">
                                    <li>
                                        <a href="{{url('admin/goods/message_add')}}" title="添加" class="add">
                                            <i class="sa-list-add"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{asset('admin/goods/index')}}" title="刷新" class="tooltips">
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
                                            {{--<th>商品ID</th>--}}
                                            <th>商品名称</th>
                                            <th>商品图片</th>
                                            <th>价格</th>
                                            <th>库存</th>
                                            <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tr @if(!$message[$v['id']]==null) hidden @endif>
                                            <td>暂无数据</td>
                                        </tr>
                                        @foreach($message[$v['id']] as $messages)
                                            <tbody>
                                            <tr>
                                                <td> {{$messages['name']}} </td>
                                                <td><img src="{{$messages['main_map']}}" alt="" style="width: 80px; height: 80px"> </td>
                                                <td> {{$messages['money']}}元 </td>
                                                <td> {{$messages['inventory']}} {{$messages['unit']}}</td>
                                                <td> @if($messages['is_shelves']==0)未上架@else已上架@endif</td>
                                                <td>
                                                    <a href="{{url('admin/goods/message_status?id='.$messages['id'])}}" class="status"><i class="icon-comment"></i> @if($messages['is_shelves']==0)上架@else下架@endif</a>
                                                    <a href="{{url('admin/goods/message_edit?id='.$messages['id'])}}" class="edit"><i class="icon-comment"></i> 修改</a>
                                                    <a href="javascript:;" data-id="{{$messages['id']}}" class="del"><i class="icon-comment"></i> 删除</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach

                        <div class="tab-pane" id="panel-999999991" style="width:85%; float: right">
                            <div class="listview list-container">
                                <header class="listview-header media">
                                    <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

                                    <ul class="list-inline list-mass-actions pull-left">
                                        <li>
                                            <a href="{{url('admin/goods/message_add')}}" title="添加" class="add">
                                                <i class="sa-list-add"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{asset('admin/goods/index')}}" title="刷新" class="tooltips">
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
                                                {{--<th>商品ID</th>--}}
                                                <th>商品名称</th>
                                                <th>商品图片</th>
                                                <th>价格</th>
                                                <th>库存</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tr @if(!$message_status1[0]==null) hidden @endif>
                                                <td>暂无数据</td>
                                            </tr>
                                            @foreach($message_status1 as $messages)
                                                <tbody>
                                                <tr>
                                                    <td> {{$messages['name']}} </td>
                                                    <td><img src="{{$messages['main_map']}}" alt="" style="width: 80px; height: 80px"> </td>
                                                    <td> {{$messages['money']}}元 </td>
                                                    <td> {{$messages['inventory']}} {{$messages['unit']}}</td>
                                                    <td> @if($messages['is_shelves']==0)未上架@else已上架@endif</td>
                                                    <td>
                                                        <a href="{{url('admin/goods/message_status?id='.$messages['id'])}}" class="status"><i class="icon-comment"></i> @if($messages['is_shelves']==0)上架@else下架@endif</a>
                                                        <a href="{{url('admin/goods/message_edit?id='.$messages['id'])}}" class="edit"><i class="icon-comment"></i> 修改</a>
                                                        <a href="javascript:;" data-id="{{$messages['id']}}" class="del"><i class="icon-comment"></i> 删除</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="media text-center">
                                    <ul class="pagination">
                                        {{$message_status1->links()}}
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="panel-999999992" style="width:85%; float: right">
                            <div class="listview list-container">
                                <header class="listview-header media">
                                    <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

                                    <ul class="list-inline list-mass-actions pull-left">
                                        <li>
                                            <a href="{{url('admin/goods/message_add')}}" title="添加" class="add">
                                                <i class="sa-list-add"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{asset('admin/goods/index')}}" title="刷新" class="tooltips">
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
                                                {{--<th>商品ID</th>--}}
                                                <th>商品名称</th>
                                                <th>商品图片</th>
                                                <th>价格</th>
                                                <th>库存</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tr @if(!$message_status0[0]==null) hidden @endif>
                                                <td>暂无数据</td>
                                            </tr>
                                            @foreach($message_status0 as $messages)
                                                <tbody>
                                                <tr>
                                                    <td> {{$messages['name']}} </td>
                                                    <td><img src="{{$messages['main_map']}}" alt="" style="width: 80px; height: 80px"> </td>
                                                    <td> {{$messages['money']}}元 </td>
                                                    <td> {{$messages['inventory']}} {{$messages['unit']}}</td>
                                                    <td> @if($messages['is_shelves']==0)未上架@else已上架@endif</td>
                                                    <td>
                                                        <a href="{{url('admin/goods/message_status?id='.$messages['id'])}}" class="status"><i class="icon-comment"></i> @if($messages['is_shelves']==0)上架@else下架@endif</a>
                                                        <a href="{{url('admin/goods/message_edit?id='.$messages['id'])}}" class="edit"><i class="icon-comment"></i> 修改</a>
                                                        <a href="javascript:;" data-id="{{$messages['id']}}" class="del"><i class="icon-comment"></i> 删除</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="media text-center">
                                    <ul class="pagination">
                                        {{$message_status0->links()}}
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="panel-999999993" style="width:85%; float: right">
                            <div class="listview list-container">
                                <header class="listview-header media">
                                    <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

                                    <ul class="list-inline list-mass-actions pull-left">
                                        <li>
                                            <a href="{{url('admin/goods/message_add')}}" title="添加" class="add">
                                                <i class="sa-list-add"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{asset('admin/goods/index')}}" title="刷新" class="tooltips">
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
                                                {{--<th>商品ID</th>--}}
                                                <th>商品名称</th>
                                                <th>商品图片</th>
                                                <th>价格</th>
                                                <th>库存</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tr @if(!$message_stockout[0]==null) hidden @endif>
                                                <td>暂无数据</td>
                                            </tr>
                                            @foreach($message_stockout as $messages)
                                                <tbody>
                                                <tr>
                                                    <td> {{$messages['name']}} </td>
                                                    <td><img src="{{$messages['main_map']}}" alt="" style="width: 80px; height: 80px"> </td>
                                                    <td> {{$messages['money']}}元 </td>
                                                    <td> {{$messages['inventory']}} {{$messages['unit']}}</td>
                                                    <td> @if($messages['is_shelves']==0)未上架@else已上架@endif</td>
                                                    <td>
                                                        <a href="{{url('admin/goods/message_status?id='.$messages['id'])}}" class="status"><i class="icon-comment"></i> @if($messages['is_shelves']==0)上架@else下架@endif</a>
                                                        <a href="{{url('admin/goods/message_edit?id='.$messages['id'])}}" class="edit"><i class="icon-comment"></i> 修改</a>
                                                        <a href="javascript:;" data-id="{{$messages['id']}}" class="del"><i class="icon-comment"></i> 删除</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="media text-center">
                                    <ul class="pagination">
                                        {{$message_stockout->links()}}
                                    </ul>
                                </div>
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--分类添加模态框--}}
<div class="modal fade" id="modalNarrower">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    分类添加
                </h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-validation-1" action="#">
                    <div class="form-group m-b-15">
                        <label>分类名称</label>
                        <input type="text" class="input-sm validate[required] form-control" placeholder="请输入分类名称" id="name1">
                    </div>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-sm" id="category_add" onClick="return false;">保存</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{--分类修改--}}
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    分类修改
                </h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-validation-1" action="#">
                    <input type="text" id="id2"  hidden>
                    <div class="form-group m-b-15">
                        <label>分类名称</label>
                        <input type="text" class="input-sm validate[required] form-control" placeholder="请输入分类名称" id="name2">
                    </div>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-sm" id="category_del" onClick="return false;">删除</button>
                    <button type="button" class="btn btn-sm" id="category_edit" onClick="return false;">保存</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{--删除分类模态框--}}
<div class="modal fade" id="del1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    删除确认
                </h4>
            </div>
            <input type="text" id="id2" hidden>
            <div class="modal-body">
                确定删除该商品分类？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-sm" id="category_del2" onClick="return false;">确定</button>
            </div>
        </div>

    </div>
</div>

{{--删除商品模态框--}}
<div class="modal fade" id="del2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    删除确认
                </h4>
            </div>
            <input type="text" id="id2" hidden>
            <div class="modal-body">
                确定删除该商品？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-sm" id="message_del" onClick="return false;">确定</button>
            </div>
        </div>

    </div>
</div>


@endsection

@section('js')
    <script>
        //添加分类
        $('#category_add').click(function(){
            var name = $('#name1').val();
            $.ajax({
                url: '/admin/goods/category_add',
                data: {name:name},
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

        function category_edit(id){
            $('#edit').modal();
            $.ajax({
                'url': '/admin/goods/category_show',
                'data': {
                    'id' :id
                },
                'type':'POST',
                'dataType':'JSON',
                'success':function(data){
                    if(data.ret == 200) {//返回查询的数据，并赋值给模态框
                        $('input[id="id2"]').val(id);
                        $('input[id="name2"]').val(data.data['name']);
                    }else  {
                        alert(data.msg);
                    }
                },
            })

            //状态修改
            $('#category_edit').click(function(){
                var id = $('#id2').val();
                var name = $('#name2').val();
                $.ajax({
                    url: '/admin/goods/category_edit',
                    data: {id:id,name:name},
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

            //分类删除
            $('#category_del').click(function(){
                $('#del1').modal();
                $('#category_del2').click(function(){
                    $.ajax({
                        url: '/admin/goods/category_del',
                        data: {id:id},
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
            })
        }

        //触发删除商品模态框
        $('.del').click(function () {
            $('#del2').modal()
            editId = $(this).data('id')
        })

        //删除商品
        $('#message_del').click(function(){
            $.ajax({
                url: '/admin/goods/message_del',
                data: {id:editId},
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