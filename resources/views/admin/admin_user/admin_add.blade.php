@extends('admin.base.base')
@section('content')
        <!-- 主体内容 -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{url('/admin/index/welcome')}}">首页</a></li>
    <li><a href="{{url('/admin/admin_user/admin_user')}}">管理员管理</a></li>
    <li class="active">管理员添加</li>
</ol>

<h4 class="page-title b-0">管理员添加</h4>

<hr class="whiter m-t-20" />


<!-- Spinner -->
<div class="block-area" id="spinner">
    <div class="row">
        <p>管理员名称</p>
        <div class="p-relative">
            <input type="text" class="form-control input-sm spinner-1 spinedit" id="name" placeholder="请输入管理员名称"/>
        </div>

        <p>管理员账号</p>
        <div class="p-relative">
            <input type="text" class="form-control input-sm spinner-1 spinedit" id="account" placeholder="请输入管理员账号"/>
        </div>

        <p>管理员密码</p>
        <div class="p-relative">
            <input type="password" class="form-control input-sm spinner-1 spinedit" id="pwd1" placeholder="请输入管理员密码"/>
        </div>

        <p>确认密码</p>
        <div class="p-relative">
            <input type="password" class="form-control input-sm spinner-1 spinedit" id="pwd2" placeholder="请二次确认密码"/>
        </div>

        <p>管理员描述</p>
        <div class="p-relative">
            <input type="text" class="form-control input-sm spinner-1 spinedit" id="describe" placeholder="请输入管理员描述"/>
        </div>

        <p>管理员权限</p>
        <ul class="fruit" id="fruit">
            @foreach($jurisdiction as $jurisdictions)
                <li><input type="checkbox" name="test" value="{{$jurisdictions['id']}}"/><span>{{$jurisdictions['name']}}</span></li>
            @endforeach
        </ul>

        <br>
        <br>
        <br>
        <br>

        <div style="position: relative; left: 40%">
            <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-sm" id="admin_user_add" onClick="return false;">提交</button>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>


        //添加管理员
        $('#admin_user_add').click(function () {
            //獲取數據
            var name = $('#name').val();
            var account = $('#account').val();
            var pwd1 = $('#pwd1').val();
            var pwd2 = $('#pwd2').val();
            var describe = $('#describe').val();
            <!--获取选中复选框的值-->
            obj = document.getElementsByName("test");
            check_val = [];
            for(k in obj){
                if(obj[k].checked)
                    check_val.push(obj[k].value);
            }
            if(name == '') {
                alert('请填写管理员名称');
                return false;
            }
            if(account == ''){
                alert('请填写管理员账号');
                return false;
            }
            if(pwd1 == '') {
                alert('请填写管理员密码');
                return false;
            }
            if(pwd2 == '') {
                alert('请填写管理员二次确认密码');
                return false;
            }
            if(describe == ''){
                alert('请填写管理员描述');
                return false;
            }
            $.ajax({
                url: '/admin/admin_user/admin_adds',
                data: {name: name,account:account,pwd1:pwd1,pwd2:pwd2,describe:describe,check_val:check_val},
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