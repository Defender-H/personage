<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 15:16
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Model\Goods_category;
use App\Model\Goods_message;
use Illuminate\Http\Request;

class CommodityController extends Controller
{
    //获取商品分类
    public function commodity_column(){
        $data = Goods_category::all();
        foreach($data as $k=>$v){
            $data[$k]['text'] = $v['name'];
            $goods[$k] = Goods_message::where(['category_id'=>$v['id']])->get();
            $children = array();
            if(!empty($goods[$k])){
                foreach($goods[$k] as $k1=>$v1){
                    $children[$k1]['text'] = $v1['name'];
                    $children[$k1]['id'] = $v1['id'];
                    $data[$k]['children'] = $children;
                }
            }
        }
        return ['ret'=>200,'msg'=>'获取商品分类成功','data'=>$data];
    }

    //获取商品分类下的商品
    public function commodity_column_show(Request $request){
        $commodity_column_id = $request->input('id');
        Goods_message::where(['category_id'=>$commodity_column_id])
            ->where(['is_shelves'=>1])
            ->select();
    }

    //获取商品全部商品
    public function commodity_list(){}

    //获取商品详情
    public function commodity_show(){}
}