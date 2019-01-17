<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/17
 * Time: 9:34
 */

namespace App\Http\Controllers\Admin;


use App\Common\Admin\Goods;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{
    /**
     * 显示商品管理页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $goods = new Goods();
        $cate = $goods->category_all();//查询出所有商品分类
        $message = $goods->message_all($cate);//查询出所有分类下商品
        $message_stockout = $goods->message_stockout();//查询出所有缺货商品
        $message_status1 = $goods->message_status1();//查询出所有上架商品
        $message_status0 = $goods->message_status0();//查询出所有下架商品
        return view('admin.goods.index',['category'=>$cate,'message'=>$message,'message_stockout'=>$message_stockout,'message_status1'=>$message_status1,'message_status0'=>$message_status0]);
    }

    /**
     * 实现商品分类添加
     * @param Request $request
     * @return array
     */
    public function category_add(Request $request){
        $data = $request->post();
        if($data['name']==null){
            return ['ret'=>0,'message'=>'分类名称不能为空'];
        }else{
            $goods = new Goods();
            $a = $goods->category_add($data);
            if($a == true){
                return ['ret'=>200,'message'=>'分类新建成功'];
            }
        }
    }

    /**
     * 实现商品分类单记录查询
     * @param Request $request
     * @return array
     */
    public function category_show(Request $request){
        $id = $request->post('id');
        $goods = new Goods();
        $a = $goods->category_show($id);
        return ['ret'=>200,'data'=>$a];
    }

    /**
     * 实现商品分类修改
     * @param Request $request
     * @return array
     */
    public function category_edit(Request $request){
        $data = $request->post();
        if($data['name']==null){
            return ['ret'=>0,'message'=>'分类名称不能为空'];
        }else{
            $goods = new Goods();
            $a = $goods->category_edit($data);
            if($a == true){
                return ['ret'=>200,'message'=>'分类修改成功'];
            }
        }
    }

    /**
     * 实现商品分类删除
     * @param Request $request
     * @return array
     */
    public function category_del(Request $request){
        $id = $request->post('id');
        $goods = new Goods();
        $a = $goods->category_del($id);
        if($a == true){
            return ['ret'=>200,'message'=>'分类删除成功'];
        }
    }

    /**
     * 显示商品添加页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function message_add(){
        $goods = new Goods();
        $a = $goods->message_add();
        return view('admin.goods.message_add',['category'=>$a]);
    }

    /**
     * 实现商品主图上传
     * @param Request $request
     * @return array
     */
    public function goods_pic(Request $request){
        $file = $request->file('pic1');
        $goods = new Goods();
        $url = $goods->goods_pic($file);
        if($url==null){
            return ['ret'=>0,'message'=>'上传商品图片失败','data'=>$url];
        }else{
            return ['ret'=>200,'message'=>'上传商品图片成功','data'=>$url];
        }
    }

    /**
     * 实现商品添加
     * @param Request $request
     * @return array
     */
    public function message_adds(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'name'=>'required',
            'unit'=>'required',
            'good_desc'=>'required',
            'main_map'=>'required',
            'is_shelves'=>'required',
            'category_id'=>'required',
            'money'=>'required',
            'inventory'=>'required',
        ],[
            'name.required'=>'请填写商品名称',
            'unit.required'=>'请填写商品单位',
            'good_desc.required'=>'请填写商品简述',
            'main_map.required'=>'请上传商品主图',
            'is_shelves.required'=>'请选择商品是否上架',
            'category_id.required'=>'请选择商品分类',
            'money.required'=>'请填写商品价格',
            'inventory.required'=>'请填写商品库存',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $goods = new Goods();
            $a = $goods->message_adds($data);
            if($a == true){
                return ['ret'=>200,'message'=>'商品添加成功'];
            }
        }
    }

    /**实现商品上下架修改
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function message_status(Request $request){
        $id = $request->input('id');
        $goods = new Goods();
        $a = $goods->message_status($id);
        if($a == true){
            return redirect('admin/goods/index');
        }
    }

    /**显示商品修改页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function message_edit(Request $request){
        $id = $request->input('id');
        $goods = new Goods();
        $a = $goods->message_edit($id);
        $b = $goods->message_add();
        return view('admin.goods.message_edit',['goods'=>$a,'category'=>$b]);
    }

    /**
     * 实现商品修改
     * @param Request $request
     * @return array
     */
    public function message_update(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'name'=>'required',
            'unit'=>'required',
            'good_desc'=>'required',
            'is_shelves'=>'required',
            'category_id'=>'required',
            'money'=>'required',
            'inventory'=>'required',
        ],[
            'name.required'=>'请填写商品名称',
            'unit.required'=>'请填写商品单位',
            'good_desc.required'=>'请填写商品简述',
            'is_shelves.required'=>'请选择商品是否上架',
            'category_id.required'=>'请选择商品分类',
            'money.required'=>'请填写商品价格',
            'inventory.required'=>'请填写商品库存',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $goods = new Goods();
            $a = $goods->message_update($data);
            if($a == true){
                return ['ret'=>200,'message'=>'商品修改成功'];
            }
        }
    }

    /**
     * 实现商品删除
     * @param Request $request
     * @return array
     */
    public function message_del(Request $request){
        $id = $request->post('id');
        $goods = new Goods();
        $a = $goods->message_del($id);
        if($a == true){
            return ['ret'=>200,'message'=>'商品删除成功'];
        }
    }
}
