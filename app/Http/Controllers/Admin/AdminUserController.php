<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/6
 * Time: 9:06
 */

namespace App\Http\Controllers\Admin;


use App\Common\Admin\AdminUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    /**
     * 显示权限管理页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jurisdiction(){
        $admin_user = new AdminUser();
        $a = $admin_user->jurisdiction();
        return view('admin.admin_user.jurisdiction',['jurisdiction'=>$a]);
    }

    /**
     * 实现管理权限添加
     * @param Request $request
     * @return array
     */
    public function jurisdiction_add(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'name'=>'required',
            'url'=>'required',
        ],[
            'name.required'=>'请填写管理权限名称',
            'url.required'=>'请填写管理权限路由',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $admin_user = new AdminUser();
            $a = $admin_user->jurisdiction_add($data);
            if($a === true){
                return ['ret'=>200,'message'=>'管理权限添加成功'];
            }
        }
    }

    /**
     * 实现管理权限单记录查询
     * @param Request $request
     * @return array
     */
    public function jurisdiction_show(Request $request){
        $id = $request->post('id');
        if($id == null){
            return ['ret'=>0,'message'=>'非法操作，未获取到id'];
        }
        $admin_user = new AdminUser();
        $a = $admin_user->jurisdiction_show($id);
        return ['ret'=>200,'data'=>$a];
    }

    /**实现管理权限修改
     * @param Request $request
     * @return array
     */
    public function jurisdiction_edit(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'name'=>'required',
            'url'=>'required',
        ],[
            'name.required'=>'请填写管理权限名称',
            'url.required'=>'请填写管理权限路由',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $admin_user = new AdminUser();
            $a = $admin_user->jurisdiction_edit($data);
            if($a === true){
                return ['ret'=>200,'message'=>'管理权限修改成功'];
            }
        }
    }

    /**
     * 实现管理权限删除
     * @param Request $request
     * @return array
     */
    public function jurisdiction_del(Request $request){
        $id = $request->post('id');
        $admin_user = new AdminUser();
        $a = $admin_user->jurisdiction_del($id);
        if($a === true){
            return ['ret'=>200,'message'=>'管理权限删除成功'];
        }
    }

    /**
     * 显示管理员管理页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin_user(){
        $admin_user = new AdminUser();
        $a = $admin_user->admin_user();
        return view('admin.admin_user.admin_user',['admin_user'=>$a]);
    }

    /**显示管理员添加页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin_add(){
        $admin_user = new AdminUser();
        $a = $admin_user->admin_jurisdiction_show();
        return view('admin.admin_user.admin_add',['jurisdiction'=>$a]);
    }

    /**实现管理员添加
     * @param Request $request
     * @return array
     */
    public function admin_adds(Request $request){
        $data = $request->post();
        if($data['pwd1']!==$data['pwd2']){
            return ['ret'=>0,'message'=>'两次密码输入不一致'];
        }
        $validator = Validator::make($data,[
            'account'=>'required|alpha|unique:admin_user',
            'pwd1'=>'required',
            'pwd2'=>'required',
            'name'=>'required',
            'describe'=>'required',
        ],[
            'account.required'=>'请填写管理员账号',
            'account.alpha'=>'该字段必须为字母',
            'account.unique'=>'该账号已存在',
            'pwd1.required'=>'请填写管理员密码',
            'pwd2.required'=>'请填写管理员二次确认密码',
            'name.required'=>'请填写管理员名称',
            'describe.required'=>'请填写管理员描述',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $admin_user = new AdminUser();
            $a = $admin_user->admin_adds($data);
            if($a === true){
                return ['ret'=>200,'message'=>'管理员添加成功'];
            }
        }
    }

    /**
     * 显示管理员修改页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin_edit($id){
        $admin_user = new AdminUser();
        $a = $admin_user->admin_edit($id);//查询出该管理员记录
        $jurisdiction_id = json_decode($a['jurisdiction_id']);//查询出已选中的权限
        $b = $admin_user->admin_jurisdiction_show();//查询出全部权限
        return view('admin.admin_user.admin_edit',['user'=>$a,'jurisdiction_id'=>$jurisdiction_id,'jurisdiction'=>$b]);
    }

    /**实现管理员修改
     * @param Request $request
     * @return array
     */
    public function admin_edits(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'name'=>'required',
            'describe'=>'required',
        ],[
            'name.required'=>'请填写管理员名称',
            'describe.required'=>'请填写管理员描述',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else {
            $admin = new AdminUser();
            $a = $admin->admin_edits($data);
            if($a === true){
                return ['ret'=>200,'message'=>'修改管理员成功'];
            }
        }
    }

    /**实现管理员删除
     * @param Request $request
     * @return array
     */
    public function admin_del(Request $request){
        $id = $request->post('id');
        $admin = new AdminUser();
        $a = $admin->admin_del($id);
        if($a === true){
            return ['ret'=>200,'message'=>'管理员删除成功'];
        }
    }
}