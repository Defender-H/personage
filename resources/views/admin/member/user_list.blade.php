@extends('admin.base.base')
@section('content')
<!-- 主体内容 -->
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{url('/admin/index/welcome')}}">Home</a></li>
    <li><a href="{{url('/admin/member/user')}}">会员用户管理</a></li>
    <li class="active">会员用户详情</li>
</ol>

<h4 class="page-title b-0">会员用户详情</h4>

<div class="block-area">
    <div class="panel-body">
        <div class="col-md-6" style="border-right: 1px solid #eee;">
            <table class="table table-info">
                <tr>
                    <td>头像：</td>
                    <td>
                        <img src="{{$user['avatar']}}" alt="" width="150px"; height="150px">
                    </td>
                </tr>
                <tr>
                    <td>昵称：</td>
                    <td>{{$user['nickname']}}</td>
                </tr>
                <tr>
                    <td>账号：</td>
                    <td>{{$user['account']}}</td>
                </tr>
                <tr>
                    <td>性别：</td>
                    <td>@if($user['sex']==1)男 @else 女@endif</td>
                </tr>
                <tr>
                    <td>手机：</td>
                    <td>{{$user['phone']}}</td>
                </tr>

            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-info">
                <tr>
                    <td>余额：</td>
                    <td>{{$user['money']}}</td>
                </tr>
                <tr>
                    <td>已消费金额：</td>
                    <td>{{$user['consume']}}</td>
                </tr>
                <tr>
                    <td>会员等级：</td>
                    <td><?php if($user['grade_id']==0){echo '普通会员';}else{$data = \App\Model\Member_grade::where(['id'=>$user['grade_id']])->first(); echo $data['name'];}?></td>
                </tr>
            </table>
        </div>
    </div>
    <div style="text-align: center">
        <a href="javascript:;" data-id="{{$user['id']}}" class="edit"><i class="icon-comment"></i><button class="btn btn-sm">修改用户资料</button></a>
    </div>

    {{--修改用户资料--}}
    <div class="modal fade" id="edit2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        修改用户资料
                    </h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-validation-1" action="#" id="uploadForm" enctype="multipart/form-data">
                        <div class="form-group m-b-15">
                            <p>头像</p>
                            <input type="text" id="id1" hidden>
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
                            <label>昵称</label>
                            <input type="text" class="input-sm validate[required] form-control" placeholder="请输入昵称名称" id="nickname1">
                            <label>性别</label>
                            <input type="text" class="input-sm validate[required] form-control" placeholder="请输入性别值，1为男，2为女" id="sex1">
                            <label>手机</label>
                            <input type="text" class="input-sm validate[required] form-control" placeholder="请输入手机号码" id="phone1">
                        </div>
                        <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-sm" id="user_edit1" onClick="return false;">提交</button>
                    </form>
                </div>
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

        //触发修改用户资料模态框
        $('.edit').click(function(){
            $('#edit2').modal()
            var id=$(this).data('id')
            $.ajax({
                'url':'/admin/member/user_show',
                'data': {
                    'id' :id
                },
                'type':'POST',
                'dataType':'JSON',
                'success':function(data){
                    if(data.ret == 200) {//返回查询的数据，并赋值给模态框]
                        $('#pic').attr('src',data.data['avatar']);
                        $('input[id="id1"]').val(data.data['id']);
                        $('input[id="nickname1"]').val(data.data['nickname']);
                        $('input[id="sex1"]').val(data.data['sex']);
                        $('input[id="phone1"]').val(data.data['phone']);
                    }else  {
                        alert(data.msg);
                    }
                },
            })
        })

        $('#user_edit1').click(function(){
            var id = $('#id1').val();
            var nickname = $('#nickname1').val();
            var sex = $('#sex1').val();
            var phone = $('#phone1').val();
            var avatar = $('#path1').val();
            if (nickname == '') {
                alert('请填写用户昵称');
                return false;
            }
            if (sex == '') {
                alert('请填写用户性别');
                return false;
            }
            if (phone == '') {
                alert('请填写用户手机号码');
                return false;
            }
            $.ajax({
                url: '/admin/member/user_edit',
                data: {id:id,nickname: nickname,sex:sex,phone:phone,avatar:avatar},
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