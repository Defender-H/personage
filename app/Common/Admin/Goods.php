<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/17
 * Time: 16:37
 */

namespace App\Common\Admin;


use App\Model\Goods_category;
use App\Model\Goods_message;

class Goods
{
    /**
     * 查询全部商品分类
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function category_all(){
        $a = Goods_category::select()
            ->orderBy('created_at')
            ->get();
        return $a;
    }


    /**
     * 商品分类添加
     * @param $data
     * @return bool
     */
    public function category_add($data){
        Goods_category::create(['name'=>$data['name']]);
        return true;
    }

    /**
     * 商品分类单记录查询
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function category_show($id){
        $a = Goods_category::where(['id'=>$id])->first();
        return $a;
    }

    /**
     * 商品分类修改
     * @param $data
     * @return bool
     */
    public function category_edit($data){
        Goods_category::where(['id'=>$data['id']])->update(['name'=>$data['name']]);
        return true;
    }

    /**
     * 商品分类以及分类下的所有商品删除
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function category_del($id){
        Goods_message::where(['category_id'=>$id])->delete();
        Goods_category::where(['id'=>$id])->delete();
        return true;
    }

    /**查询各个分类的商品
     * @param $cate
     * @return mixed
     */
    public function message_all($cate){
        $s = count($cate);
        if($s == 0){
            $a = null;
        }
        for($i=0;$i<$s;$i++){
            $a[$cate[$i]['id']] = Goods_message::where(['category_id'=>$cate[$i]['id']])->get()->toArray();
        }
        return $a;
    }

    /**
     * 查询所有上架商品
     * @return array
     */
    public function message_status1(){
        $a = Goods_message::where(['is_shelves'=>1])->select()->orderBy('created_at')->paginate(6);
        return $a;
    }

    /**
     * 查询所以下架商品
     * @return array
     */
    public function message_status0(){
        $a = Goods_message::where(['is_shelves'=>0])->select()->orderBy('created_at')->paginate(6);
        return $a;
    }

    /**
     * 查询所有缺货商品
     * @return array
     */
    public function message_stockout(){
        $a = Goods_message::where(['inventory'=>0])->select()->orderBy('created_at')->paginate(6);
        return $a;
    }

    /**
     * 查询所有商品分类
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function message_add(){
        $a = Goods_category::all();
        return $a;
    }

    /**
     * 商品主图上传
     * @param $pic
     * @return string
     */
    public function goods_pic($pic){
        $path = $pic->store('admin/goods_pic','public');
        $url = '/storage/'.$path;
        return $url;
    }

    /**
     * 商品添加
     * @param $data
     * @return bool
     */
    public function message_adds($data){
        Goods_message::create([
            'name'=>$data['name'],
            'unit'=>$data['unit'],
            'goods_desc'=>$data['good_desc'],
            'main_map'=>$data['main_map'],
            'is_shelves'=>$data['is_shelves'],
            'category_id'=>$data['category_id'],
            'money'=>$data['money'],
            'inventory'=>$data['inventory'],
        ]);
        return true;
    }

    /**
     * 商品上下架修改
     * @param $id
     * @return bool
     */
    public function message_status($id){
        $message = Goods_message::where(['id'=>$id])->first();
        if($message['is_shelves']==0){//商品未上架
            Goods_message::where(['id'=>$id])->update(['is_shelves'=>1]);
            return true;
        }else{
            Goods_message::where(['id'=>$id])->update(['is_shelves'=>0]);
            return true;
        }
    }

    /**商品单记录查询
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function message_edit($id){
        $a = Goods_message::where(['id'=>$id])->first();
        return $a;
    }

    /**
     * 修改商品
     * @param $data
     * @return bool
     */
    public function message_update($data){
        if($data['main_map']==null){
            Goods_message::where(['id'=>$data['id']])->update([
                'name'=>$data['name'],
                'unit'=>$data['unit'],
                'goods_desc'=>$data['good_desc'],
                'is_shelves'=>$data['is_shelves'],
                'category_id'=>$data['category_id'],
                'money'=>$data['money'],
                'inventory'=>$data['inventory'],
            ]);
            return true;
        }else{
            Goods_message::where(['id'=>$data['id']])->update([
                'name'=>$data['name'],
                'unit'=>$data['unit'],
                'goods_desc'=>$data['good_desc'],
                'main_map'=>$data['main_map'],
                'is_shelves'=>$data['is_shelves'],
                'category_id'=>$data['category_id'],
                'money'=>$data['money'],
                'inventory'=>$data['inventory'],
            ]);
            return true;
        }

    }

    /**
     * 删除商品
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function message_del($id){
        Goods_message::where(['id'=>$id])->delete();
        return true;
    }
}