@extends('admin.base.base')
@section('content')
<!-- 主体内容 -->
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{url('/admin/index/welcome')}}">Home</a></li>
    <li class="active">会员等级管理</li>
</ol>

<h4 class="page-title b-0">会员等级管理</h4>

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
                <a href="{{url('admin/member/grade')}}" title="刷新" class="tooltips">
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
                        <th>会员名称</th>
                        <th>升级条件</th>
                        <th>会员折扣</th>
                        <th>修改时间</th>
                        <th>操作</th>
                    </tr>
                    <tr><td colspan="5" align="center" @if(!$grade[0]==null) hidden @endif>暂无数据</td></tr>
                    </thead>
                    @foreach($grade as $grades)
                    <tbody>

                    <tr>
                        <td>{{$grades['id']}}</td>
                        <td>{{$grades['name']}}</td>
                        <td>消费{{$grades['condition']}}元</td>
                        <td>{{$grades['discount']}}</td>
                        <td>{{$grades['updated_at']}}</td>
                        <td>
                            @if($grades['id']==8) 禁止操作 @endif
                            <a href="javascript:;" data-id="{{$grades['id']}}" class="edit" @if($grades['id']==8) hidden @endif><i class="icon-comment"></i>修改</a>
                            <a href="javascript:;" data-id="{{$grades['id']}}" class="del" @if($grades['id']==8) hidden @endif><i class="icon-comment"></i>删除</a>
                        </td>
                    </tr>
                    </tbody>

                    @endforeach
                </table>
            </div>
        </div>

    <div class="media text-center">
        <ul class="pagination">
            {{$grade->links()}}
        </ul>
    </div>
</div>

{{--添加会员等级模态框--}}
<div class="modal fade" id="modalNarrower" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">添加会员等级</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-validation-1" action="#">
                    <div class="form-group m-b-15">
                        <label>会员等级名称：</label>
                        <input type="text" class="input-sm validate[required] form-control" placeholder="请输入会员等级名称" id="name1">
                        <label>升级条件：</label>
                        <div>
                            <p style="float: left;">消费满 &numsp;</p>
                            <input type="number" style="float: left; width: 30%; height: 20px" class="input-sm validate[required] form-control" placeholder="请输入金额" id="condition1">
                            <p>&numsp;元</p>
                        </div>
                        <label>会员折扣：</label>
                        <div>
                            <input type="number" class="input-sm validate[required] form-control" placeholder="请输入会员折扣" id="discount1">
                        </div>
                        <p style="color: red">注：会员折扣在0-1之间</p>
                    </div>
                    <br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-sm" id="grade_add" onClick="return false;">提交</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{--修改会员等级模态框--}}
<div class="modal fade" id="edit2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">修改会员等级</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-validation-1" action="#">
                    <input type="text" id="id2" hidden>
                    <div class="form-group m-b-15">
                        <label>会员等级名称</label>
                        <input type="text" class="input-sm validate[required] form-control" placeholder="请输入会员等级名称" id="name2">
                        <label>升级条件</label>
                        <div>
                            <p style="float: left;">消费满 &numsp;</p>
                            <input type="number" style="float: left; width: 30%; height: 20px" class="input-sm validate[required] form-control" placeholder="请输入金额" id="condition2">
                            <p>&numsp;元</p>
                        </div>
                        <label>会员折扣：</label>
                        <div>
                            <input type="number" class="input-sm validate[required] form-control" placeholder="请输入会员折扣" id="discount2">
                        </div>
                        <p style="color: red">注：会员折扣在0-1之间</p>
                    </div>
                    <br>
                    <div style="text-align: center">
                        <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-sm" id="grade_edit" onClick="return false;">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--删除会员等级模态框--}}
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
                确定删除该会员等级吗？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-sm" id="grade_del" onClick="return false;">确定</button>
            </div>
        </div>

    </div>

</div>
@endsection

@section('js')
    <script>
        //添加会员等级
        $('#grade_add').click(function(){
            //獲取數據
            var name = $('#name1').val();
            var condition =$('#condition1').val();
            var discount = $('#discount1').val();
            if (name == '') {
                alert('请填写会员等级名称');
                return false;
            }
            if (condition == '') {
                alert('请填写升级条件');
                return false;
            }
            if (discount == '') {
                alert('请填写会员折扣');
                return false;
            }
            $.ajax({
                url: '/admin/member/grade_add',
                data: {name: name,condition:condition,discount:discount},
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


        //触发修改会员等级模态框
            $('.edit').click(function () {
                $('#edit2').modal()
                var id=$(this).data('id')
                $.ajax({
                    'url': '/admin/member/grade_show',
                    'data': {
                        'id' :id
                    },
                    'type':'POST',
                    'dataType':'JSON',
                    'success':function(data){
                        if(data.ret == 200) {//返回查询的数据，并赋值给模态框
                            $('input[id="id2"]').val(id);
                            $('input[id="name2"]').val(data.data['name']);
                            $('input[id="condition2"]').val(data.data['condition']);
                            $('input[id="discount2"]').val(data.data['discount']);
                        }else  {
                            alert(data.msg);
                        }
                    },
                })
        })

        //修改会员等级
        $('#grade_edit').click(function(){
            //獲取數據
            var id = $('#id2').val();
            var name = $('#name2').val();
            var condition = $('#condition2').val();
            var discount = $('#discount2').val();
            if (name == '') {
                alert('请填写会员等级名称');
                return false;
            }
            if (condition == '') {
                alert('请填写升级条件');
                return false;
            }
            if (discount == '') {
                alert('请填写会员折扣');
                return false;
            }
            $.ajax({
                url: '/admin/member/grade_edit',
                data: {id:id,name: name,condition:condition,discount:discount},
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

        //触发删除会员等级模态框
        $('.del').click(function () {
            $('#del2').modal()
            editId = $(this).data('id')
        })

        //删除会员等级
        $('#grade_del').click(function(){
            $.ajax({
                url: '/admin/member/grade_del',
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