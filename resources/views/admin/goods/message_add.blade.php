@extends('admin.base.base')
@section('content')
    <!-- 主体内容 -->
    <!-- Breadcrumb -->
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{url('/admin/index/welcome')}}">Home</a></li>
        <li><a href="{{url('/admin/goods/index')}}">商品管理</a></li>
        <li class="active">商品添加</li>
    </ol>

    <h4 class="page-title b-0">商品添加</h4>

    <hr class="whiter m-t-20" />


    <!-- Spinner -->
    <div class="block-area" id="spinner">
        <div class="row">
            <p>商品名称:</p>
            <div class="p-relative">
                <input type="text" class="form-control input-sm spinner-1 spinedit" id="name" />
            </div>

            <p>所属分类:</p>
            <div class="col-md-2 m-b-15" style="width: 100%">
                <select class="select" style="width: 100%" id="category_id">
                    @foreach($category as $categorys)
                    <option value="{{$categorys['id']}}">{{$categorys['name']}}</option>
                    @endforeach
                </select>
            </div>

            <p>商品简介:</p>
            <div class="p-relative">
                <input type="text" class="form-control input-sm spinner-1 spinedit" id="good_desc" />
            </div>

            <form role="form" class="form-validation-1" action="#" id="uploadForm" enctype="multipart/form-data">
                <p>商品主图:</p>
                <input type="text" value="" id="main_map" hidden>
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-preview thumbnail form-control"></div>
                    <div>
                            <span class="btn btn-file btn-alt btn-sm">
                                <span class="fileupload-new">选择图片</span>
                                <span class="fileupload-exists">更换</span>
                                <input type="file" id="pic1" name="pic1"/>
                            </span>
                        <button type="button" class="btn fileupload-exists btn-sm" id="goods_pic1" onClick="return false;">上传</button>
                    </div>
                </div>
            </form>

            <div>
                <p style="float: left">商品价格:</p>
                <div class="p-relative" style="float: left; width: 21%">
                    <input type="number" class="form-control input-sm spinner-1 spinedit" id="money" />
                </div>

                <p style="float: left">商品库存:</p>
                <div class="p-relative" style="float: left; width: 21%">
                    <input type="number" class="form-control input-sm spinner-1 spinedit" id="inventory" />
                </div>

                <p style="float: left">商品单位:</p>
                <div class="p-relative" style="float: left; width: 21%">
                    <input type="text" class="form-control input-sm spinner-1 spinedit" id="unit"/>
                </div>



                <p style="float: left">是否上架:</p>
                <div class="col-md-2 m-b-15" style="float: left; width: 21%">
                    <select class="select" style="width: 100%; float: left" id="is_shelves" >
                        <option value="0">不上架</option>
                        <option value="1">上架</option>
                    </select>
                </div>
            </div>


            <br>
            <br>
            <br>
            <br>

            <div style="position: relative; left: 40%">
                <button type="button" class="btn btn-sm" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-sm" id="goods_adds" onClick="return false;">提交</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    //上传商品主图
    $('#goods_pic1').click(function(){
        //獲取數據
        var formData = new FormData(document.getElementById("uploadForm"));
        $.ajax({
            url: '/admin/goods/goods_pic',
            data: formData,
            type: "POST",//规定请求的类型（GET 或 POST）。
            dataType: "JSON",//预期的服务器响应的数据类型。
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.ret == 200) {
                    $('input[id="main_map"]').val(data.data);
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            }
        })
    })


    //添加商品
    $('#goods_adds').click(function () {
        //獲取數據

        var name = $('#name').val();
        var unit = $('#unit').val();
        var good_desc = $('#good_desc').val();
        var main_map = $('#main_map').val();
        var is_shelves = $('#is_shelves').val();
        var category_id = $('#category_id').val();
        var money = $('#money').val();
        var inventory = $('#inventory').val();
        $.ajax({
            url: '/admin/goods/message_adds',
            data: {name: name,unit:unit,good_desc:good_desc,main_map:main_map,is_shelves:is_shelves,category_id:category_id,money:money,inventory:inventory,},
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