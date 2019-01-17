@extends('mobile.base.base')
@section('content')
    {{--主题内容--}}
    <div id="head">
        <van-nav-bar title="首页" left-text="返回" left-arrow @click-left="onClickLeft" @click-right="onClickRight">
        <van-icon name="search" slot="right" />
        </van-nav-bar>
    </div>

    {{--轮播图--}}
    <div id="app1">
        <van-swipe :autoplay="3000">
            <van-swipe-item v-for="(image, index) in images" :key="index">
                <a :href="index">
                    <img v-lazy="image" :src="image" height="150" width="100%"/>
                </a>
            </van-swipe-item>
        </van-swipe>
    </div>

    {{--跳转标签--}}
    <div id="app2">
        <van-col span="6" v-for="(image, index) in images" :key="index">
            <a :href="index">
                <div align="center">
                    <img v-lazy="image" :src="image" style="width: 90%"/>
                    待付款
                </div>
            </a>
        </van-col>
    </div>

    {{--商品标签--}}
    {{--<div id="app3">--}}
        {{--<van-col span="6" v-for="(image, index) in images" :key="index">--}}
            {{--<a :href="index">--}}
                {{--<div align="center">--}}
                    {{--<img v-lazy="image" :src="image" style="width: 90%"/>--}}
                    {{--待付款--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</van-col>--}}
    {{--</div>--}}
@endsection

@section('js')
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
        new Vue({
            el: '#app1',
            data() {
                return {
                    images: [
                        'https://img.yzcdn.cn/2.jpg',
                        'https://img.yzcdn.cn/2.jpg'
                    ]
                }
            },
            methods: {
                onChange(index) {
                    alert('当前 Swipe 索引：' + index);
                }
            }
        })

        new Vue({
            el: '#app2',
            data() {
                return {
                    images: [
                        'https://img.yzcdn.cn/2.jpg',
                        'https://img.yzcdn.cn/2.jpg',
                        'https://img.yzcdn.cn/2.jpg',
                        'https://img.yzcdn.cn/2.jpg'
                    ]
                }
            },
        })

//        new Vue({
//            el:'#app3',
//            data(){
//                return {
//                }
//            }
//        })

    </script>
@endsection