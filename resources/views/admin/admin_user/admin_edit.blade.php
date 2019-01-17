@extends('admin.base.base')
@section('content')
        <!-- 主体内容 -->
<ol class="breadcrumb hidden-xs">
    <li><a href="{{url('/admin/index/welcome')}}">首页</a></li>
    <li><a href="{{url('/admin/admin_user/admin_user')}}">管理员管理</a></li>
    <li class="active">管理员修改</li>
</ol>

<h4 class="page-title b-0">管理员修改</h4>

<hr class="whiter m-t-20" />


<!-- Spinner -->
<div class="block-area" id="spinner">
    <div class="row">
        <input type="text" id="id" value="{{$user['id']}}" hidden>
        <p>管理员名称</p>
        <div class="p-relative">
            <input type="text" class="form-control input-sm spinner-1 spinedit" id="name" value="{{$user['name']}}"/>
        </div>

        <p>管理员描述</p>
        <div class="p-relative">
            <input type="text" class="form-control input-sm spinner-1 spinedit" id="describe" value="{{$user['describe']}}"/>
        </div>

        <p>管理员权限</p>
        <ul class="fruit" id="fruit">
            @foreach($jurisdiction as $jurisdictions)
                <li><input type="checkbox" name="test" value="{{$jurisdictions['id']}}" @foreach($jurisdiction_id as $v) @if($jurisdictions['id']==$v) checked @endif @endforeach/><span>{{$jurisdictions['name']}}</span></li>
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


        //修改管理员
        $('#admin_user_add').click(function () {
            //獲取數據
            var id = $('#id').val();
            var name = $('#name').val();
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
            if(describe == ''){
                alert('请填写管理员描述');
                return false;
            }
            $.ajax({
                url: '/admin/admin_user/admin_edits',
                data: {id:id,name: name,describe:describe,check_val:check_val},
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