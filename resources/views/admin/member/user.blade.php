@extends('admin.base.base')
@section('content')
<!-- 主体内容 -->
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{url('/admin/index/welcome')}}">Home</a></li>
    <li class="active">会员用户管理</li>
</ol>

<h4 class="page-title b-0">会员用户管理</h4>

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
                <a href="{{url('admin/member/user')}}" title="刷新" class="tooltips">
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
                        <th>账户</th>
                        <th>头像</th>
                        <th>会员等级</th>
                        <th>注册时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    @foreach($user as $users)
                    <tbody>
                    <tr>
                        <td>{{$users['id']}}</td>
                        <td>{{$users['account']}}</td>
                        <td><img src="{{$users['avatar']}}" alt="" height="100px" width="150px"></td>
                        <td><?php if($users['grade_id']==0){echo '普通会员';}else{$data = \App\Model\Member_grade::where(['id'=>$users['grade_id']])->first(); echo $data['name'];}?></td>
                        <td>{{$users['created_at']}}</td>
                        <td>
                            <a href="{{url('admin/member/user_list?id='.$users['id'])}}" data-id="{{$users['id']}}" class="list"><i class="icon-comment"></i>显示</a>
                            <a href="javascript:;" data-id="{{$users['id']}}" class="edit"><i class="icon-comment"></i>修改</a>
                            <a href="javascript:;" data-id="{{$users['id']}}" class="del"><i class="icon-comment"></i>删除</a>
                        </td>
                    </tr>
                    </tbody>

                    @endforeach
                </table>
            </div>
        </div>

    <div class="media text-center">
        <ul class="pagination">
            {{$user->links()}}
        </ul>
    </div>
</div>

{{--添加用户模态框--}}
<div class="modal fade" id="modalNarrower" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">添加用户</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-validation-1" action="#" id="uploadForm" enctype="multipart/form-data">
                    <div class="form-group m-b-15">
                        <p>头像</p>
                        <input type="text" value="" id="path1" hidden>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-preview thumbnail form-control"></div>
                            <div>
                            <span class="btn btn-file btn-alt btn-sm">
                                <img src="" alt="">
                                <span class="fileupload-new">选择图片</span>
                                <span class="fileupload-exists">更换</span>
                                <input type="file" id="avatar1" name="avatar1"/>
                            </span>
                                <button type="button" class="btn fileupload-exists btn-sm" id="user_avatar1" onClick="return false;">上传</button>
                            </div>
                        </div>

                        <label>账户</label>
                        <input type="text" class="input-sm validate[required] form-control" placeholder="请输入账户名称" id="account1">
                        <label>密码</label>
                        <input type="password" class="input-sm validate[required] form-control" placeholder="请输入账户密码" id="password1">
                    </div>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-sm" id="user_add1" onClick="return false;">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{--修改用户密码、会员等级、充值模态框--}}
<div class="modal fade" id="edit2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    修改
                </h4>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12 column">
                        <div class="tabbable" id="tabs-856443">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#panel-42392" data-toggle="tab">修改用户密码</a>
                                </li>
                                <li>
                                    <a href="#panel-228621" data-toggle="tab">修改用户等级</a>
                                </li>
                                <li>
                                    <a href="#panel-228988" data-toggle="tab">充值</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="panel-42392">
                                    <form role="form">
                                        <input type="text" id="id21" value="" hidden>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">原密码</label>
                                            <input type="password" class="form-control" id="password21"/>
                                            <label for="exampleInputEmail1">新密码</label>
                                            <input type="password" class="form-control" id="password22"/>
                                        </div>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <button type="button" class="btn btn-primary" id="user_edit21" onClick="return false;">提交</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="panel-228621">
                                    <form role="form">
                                        <div class="form-group">
                                            <input type="text" id="id22" value="" hidden>
                                            <label for="exampleInputEmail1">会员等级</label>
                                            <select class="col-sm-2 form-control" style="margin-top:5px;" id="FORT2" onchange="setSelectVal('FORT2')">
                                                <option value='0'>普通会员</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <button type="button" class="btn btn-primary" id="user_edit22" onClick="return false;">提交</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="panel-228988">
                                    <form role="form">
                                        <div class="form-group">
                                            <input type="text" id="id23" value="" hidden>
                                            <label for="exampleInputEmail1">会员余额</label>
                                            <input type="number" min="0" step="0.01" class="form-control" id="money23"/>
                                        </div>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <button type="button" class="btn btn-primary" id="user_edit23" onClick="return false;">提交</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--删除用户模态框--}}
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
                确定删除该用户？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-sm" id="user_del" onClick="return false;">确定</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        //上传用户头像
        $('#user_avatar1').click(function(){
            //獲取數據
            var formData = new FormData(document.getElementById("uploadForm"));
            $.ajax({
                url: '/admin/member/user_avatar',
                data: formData,
                type: "POST",//规定请求的类型（GET 或 POST）。
                dataType: "JSON",//预期的服务器响应的数据类型。
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.ret == 200) {
                        $('input[id="path1"]').val(data.data);
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                }
            })
        })

        //添加用户
        $('#user_add1').click(function(){
            //獲取數據

            var avatar = $('#path1').val();
            var account = $('#account1').val();
            var password = $('#password1').val();
            if (avatar == '') {
                alert('请上传头像图片');
                return false;
            }
            if (account == '') {
                alert('请填写用户账户名称');
                return false;
            }
            if (password == '') {
                alert('请填写用户账户密码');
                return false;
            }
//            alert(password);
            $.ajax({
                url: '/admin/member/user_add',
                data: {avatar:avatar,account:account,password:password},
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

        //触发修改密码、会员等级模态框
        $('.edit').click(function(){
            $('#edit2').modal()
            var id=$(this).data('id')
            $.ajax({
                'url':'/admin/member/user_grade_show',
                'data': {
                    'id' :id
                },
                'type':'POST',
                'dataType':'JSON',
                'success':function(data){
                    if(data.ret == 200) {//返回查询的数据，并赋值给模态框
                        $('input[id="id21"]').val(id);
                        $('input[id="id22"]').val(id);
                        $('input[id="id23"]').val(id);
                        $('input[id="money23"]').val(data.grade_id['money']);
//                        $('input[id="grade_id22"]').val(data.data);
                        var str = null;
                        var temp = data['data'] + "";//需要添加，不然無法識別轉化為字符串
                        var strarr = temp.split(",");
                        for (i = 0; i < strarr.length; i++) {
                            if (data.grade_id['grade_id']==data.data[i]['id']) {
                                str += "<option value='" + data.data[i]['id'] + "' selected>" + data.data[i]['name'] + "</option>";
                            } else {
                                str += "<option value='" + data.data[i]['id'] + "'>" + data.data[i]['name'] + "</option>";
                            }
                        }
                        $("#FORT2").html(str);
                        $("#FORT2").val(data.data[i]['name']);
                        str = null;
                    }else  {
                        alert(data.msg);
                    }
                },
            })
        })

        //修改密码
        $('#user_edit21').click(function(){
            //獲取數據
            var id = $('#id21').val();
            var password1 = $('#password21').val();
            var password2 = $('#password22').val();
            if (password1 == '') {
                alert('请填写原密码');
                return false;
            }
            if (password2 == '') {
                alert('请填写新密码');
                return false;
            }
            $.ajax({
                url: '/admin/member/user_password_edit',
                data: {id:id,password1: password1,password2:password2},
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

        //修改会员等级
        $('#user_edit22').click(function(){
            //獲取數據
            var id = $('#id22').val();
            var grade_id = $('#FORT2').val();
            if (grade_id == '') {
                alert('请选择会员等级');
                return false;
            }
            $.ajax({
                url: '/admin/member/user_grade_edit',
                data: {id:id,grade_id: grade_id},
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

        //修改会员余额
        $('#user_edit23').click(function(){
            //獲取數據
            var id = $('#id23').val();
            var money = $('#money23').val();
            if (money == '') {
                alert('请填写会员余额');
                return false;
            }
            $.ajax({
                url: '/admin/member/user_money',
                data: {id:id,money: money},
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

        //触发删除用户模态框
        $('.del').click(function () {
            $('#del2').modal()
            editId = $(this).data('id')
        })

        //删除用户
        $('#user_del').click(function(){
            $.ajax({
                url: '/admin/member/user_del',
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