@extends('admin.base.base')
@section('content')
<!-- 主体内容 -->
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{url('/admin/index/welcome')}}">Home</a></li>
    {{--<li><a href="#">Library</a></li>--}}
    <li class="active">公告栏目管理</li>
</ol>

<h4 class="page-title b-0">公告栏目管理</h4>

<div class="listview list-container">
    <header class="listview-header media">
        <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

        <ul class="list-inline list-mass-actions pull-left">
            <li>
                <a data-toggle="modal" href="#modalNarrower" title="添加" class="tooltips">
                    <i class="sa-list-add"></i>
                </a>
            </li>
            <li>
                <a href="{{url('admin/notice/column_index')}}" title="刷新" class="tooltips">
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

    {{--<div class="media">--}}
        <!-- Table Hover -->
        <div class="block-area" id="tableHover">
            <div class="table-responsive overflow">
                <table class="table table-bordered table-hover tile">
                    <thead>
                    <tr>
                        {{--<th> <input type="checkbox" class="pull-left list-parent-check" value=""></th>--}}
                        <th>ID</th>
                        <th>栏目名称</th>
                        <th>栏目下文章数目</th>
                        <th>修改时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    @foreach($column as $columns)
                    <tbody>
                    <tr>
                        {{--<td><input type="checkbox" class="pull-left list-check" value=""></td>--}}
                        <td>{{$columns['id']}}</td>
                        <td>{{$columns['name']}}</td>
                        <td><?php $data = \App\Model\Notice_article::where(['column_id'=>$columns['id']])->get(); $a = count($data); echo $a?></td>
                        <td>{{$columns['updated_at']}}</td>
                        <td>
                            <a href="javascript:;" data-id="{{$columns['id']}}" class="edit"><i class="icon-comment"></i>修改</a>
                            <a href="javascript:;" data-id="{{$columns['id']}}" class="del"><i class="icon-comment"></i>删除</a>
                        </td>
                    </tr>
                    </tbody>

                    @endforeach
                </table>
            </div>
        </div>
    {{--</div>--}}

    <div class="media text-center">
        <ul class="pagination">
            {{$column->links()}}
        </ul>
    </div>
</div>

{{--添加栏目模态框--}}
<div class="modal fade" id="modalNarrower" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">添加公告栏目</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-validation-1" action="#">
                    <div class="form-group m-b-15">
                        <label>公告栏目名称</label>
                        <input type="text" class="input-sm validate[required] form-control" placeholder="请输入公告栏目名称" id="name1">
                    </div>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-sm" id="column_add" onClick="return false;">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{--修改栏目模态框--}}
<div class="modal fade" id="edit2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">修改公告栏目</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-validation-1" action="#">
                    <input type="text" id="id2"  hidden>
                    <div class="form-group m-b-15">
                        <label>公告栏目名称</label>
                        <input type="text" class="input-sm validate[required] form-control" placeholder="请输入公告栏目名称" id="name2">
                    </div>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-sm" id="column_edit" onClick="return false;">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{--删除栏目模态框--}}
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
                确定删除该栏目？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-sm" id="column_del" onClick="return false;">确定</button>
            </div>
        </div>

    </div>

</div>
@endsection

@section('js')
    <script>
        //添加公告栏目
        $('#column_add').click(function(){
            //獲取數據
            var name = $('#name1').val();
            if (name == '') {
                alert('请填写公告栏目名称');
                return false;
            }
            $.ajax({
                url: '/admin/notice/column_add',
                data: {name: name},
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


        //触发修改公告栏目模态框,进行单公告栏目查询显示
            $('.edit').click(function () {
                $('#edit2').modal()
                var id=$(this).data('id')
                $.ajax({
                    'url': '/admin/notice/column_show',
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
        })

        //修改公告栏目
        $('#column_edit').click(function(){
            //獲取數據
            var id = $('#id2').val();
            var name = $('#name2').val();
            if (name == '') {
                alert('请填写公告栏目名称');
                return false;
            }
            $.ajax({
                url: '/admin/notice/column_edit',
                data: {id:id,name: name},
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


        //触发删除模态框,进行单个公告栏目记录查询
        $('.del').click(function () {
            $('#del2').modal()
            editId = $(this).data('id')
        })

        //删除公告栏目
        $('#column_del').click(function(){

            $.ajax({
                url: '/admin/notice/column_del',
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