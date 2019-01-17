@extends('admin.base.base')
@section('content')
    <!-- 主体内容 -->
    <!-- Breadcrumb -->
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{url('/admin/index/welcome')}}">Home</a></li>
        <li><a href="{{url('/admin/notice/article_index')}}">公告文章管理</a></li>
        <li class="active">公告文章修改</li>
    </ol>

    <h4 class="page-title b-0">公告文章修改</h4>

    <hr class="whiter m-t-20" />


    <!-- Spinner -->
    <div class="block-area" id="spinner">
        <div class="row">
            <input type="text" id="id" value="{{$article['id']}}" hidden>
            <p>文章标题</p>
            <div class="p-relative">
                <input type="text" class="form-control input-sm spinner-1 spinedit" id="title" value="{{$article['title']}}" />
            </div>

            <p>所属栏目</p>
            <div class="col-md-2 m-b-15" style="width: 100%">
                <select class="select" style="width: 100%" id="column_id">
                    @foreach($column as $columns)
                    <option value="{{$columns['id']}}" @if($article['column_id']==$columns['id']) selected @endif>{{$columns['name']}}</option>
                    @endforeach
                </select>
            </div>

            <p>文章简介</p>
            <div class="p-relative">
                <input type="text" class="form-control input-sm spinner-1 spinedit" id="synopsis" value="{{$article['synopsis']}}"/>
            </div>

            <p>文章内容</p>
                <textarea id="container" name="container" >
                    {{$article['content']}}
                </textarea>
            <p>是否启用</p>
            <div class="col-md-2 m-b-15" style="width: 100%">
                <select class="select" style="width: 100%" id="status">
                    <option value="0" @if($article['status']==0) selected @endif>不启用</option>
                    <option value="1" @if($article['status']==1) selected @endif>启用</option>
                </select>
            </div>

            <br>
            <br>
            <br>
            <br>

            <div style="position: relative; left: 40%">
                <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-sm" id="article_add" onClick="return false;">提交</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
{{--<!-- 配置文件 -->--}}
<script type="text/javascript" src="{{asset('admin/SuperAdmin_bootstrap/js/ueditor/ueditor.config.js')}}"></script>
{{--<!-- 编辑器源码文件 -->--}}
<script type="text/javascript" src="{{asset('admin/SuperAdmin_bootstrap/js/ueditor/ueditor.all.js')}}"></script>
{{--<!-- 实例化编辑器 -->--}}
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
<script>
    //修改公告栏目
    $('#article_add').click(function () {
        //獲取數據

        var id = $('#id').val();
        var title = $('#title').val();
        var column_id = $('#column_id').val();
        var synopsis = $('#synopsis').val();
        var content = ue.getContent();
        var status = $('#status').val();
        $.ajax({
            url: '/admin/notice/article_edit',
            data: {id:id,title: title,column_id:column_id,synopsis:synopsis,content:content,status:status},
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