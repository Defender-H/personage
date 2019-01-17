@extends('mobile.base.base')
@section('content')
    {{--主题内容--}}
    <div id="head">
        <van-nav-bar title="分类" left-text="返回" left-arrow @click-left="onClickLeft" @click-right="onClickRight">
        <van-icon name="search" slot="right" />
        </van-nav-bar>
    </div>

    {{--分类选择--}}
    <div id="app1">
        {{--<van-tree-select--}}
                {{--:items="items"--}}
                {{--:main-active-index="mainActiveIndex"--}}
        {{--@navclick="onNavClick"--}}
        {{--@itemclick="onItemClick"--}}
        {{--/>--}}
        
        <div>
            <img src="" alt="">
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script>
        //    头部
        new Vue({
            el: '#head',
            methods: {
                onClickLeft() {
                    alert('返回');
                },
                onClickRight() {
                    window.location.href='/base/search';
                }
            },
        })

        //正文
        app1 = new Vue({
            el: '#app1',
            data:{
                items: '',
                mainActiveIndex: 0,
                // 被选中元素的id
                activeId: 0
            },
            methods: {
                onNavClick(index) {
                    this.mainActiveIndex = index;
                },
                onItemClick(data) {
                    alert(data.id);
                    this.activeId = data.id;
                },
                commodity_column(){
                    var _this = this
                    $.ajax({
                        url: '/api/goods/commodity_column',
                        type: 'GET',
                        dataType: 'JSON',
                        success: function (res) {
                            if (res.ret == 200) {
                                _this.items = res.data
                            }
                        }
                    })
                }
            }
        })

        app1.commodity_column();
    </script>
@endsection