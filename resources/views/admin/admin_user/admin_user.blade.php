@extends('admin.base.base')
@section('content')
        <!-- 主体内容 -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{url('/admin/index/welcome')}}">首页</a></li>
    <li class="active">管理员管理</li>
</ol>

<h4 class="page-title b-0">管理员管理</h4>

<div class="listview list-container">
    <header class="listview-header media">
        <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

        <ul class="list-inline list-mass-actions pull-left">
            <li>
                <a data-toggle="modal" href="{{url('/admin/admin_user/admin_add')}}" title="添加" class="tooltips">
                    <i class="sa-list-add"></i>
                </a>
            </li>
            <li>
                <a href="{{url('admin/admin_user/admin_user')}}" title="刷新" class="tooltips">
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
                    <th>管理员账号</th>
                    <th>管理员名称</th>
                    <th>管理员描述</th>
                    <th>操作</th>
                </tr>
                </thead>
                @foreach($admin_user as $admin_users)
                    <tbody>
                    <tr>
                        <td>{{$admin_users['id']}}</td>
                        <td>{{$admin_users['account']}}</td>
                        <td>{{$admin_users['name']}}</td>
                        <td>{{$admin_users['describe']}}</td>
                        <td>
                            <a href="{{url('/admin/admin_user/admin_edit',$admin_users['id'])}}"><i class="icon-comment"></i>修改</a>
                            <a href="javascript:;" data-id="{{$admin_users['id']}}" class="del"><i class="icon-comment"></i>删除</a>
                        </td>
                    </tr>
                    </tbody>

                @endforeach
            </table>
        </div>
    </div>

    <div class="media text-center">
        <ul class="pagination">
            {{$admin_user->links()}}
        </ul>
    </div>
</div>

{{--删除管理员模态框--}}
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
                确定删除该管理员？
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
        //触发删除模态框
        $('.del').click(function () {
            $('#del2').modal()
            editId = $(this).data('id')
        })

        //删除管理员
        $('#column_del').click(function(){

            $.ajax({
                url: '/admin/admin_user/admin_del',
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