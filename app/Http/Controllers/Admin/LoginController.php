<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 9:28
 */

namespace App\Http\Controllers\Admin;


use App\Common\Admin\Login;
use App\Http\Controllers\Controller;
use App\Model\Admin_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //显示登陆界面和实现登陆
    public function login_list(Request $request){
        $data = $request->post();
        $a='';
        if(!$data==null){
            $admin_user = Admin_user::where(['account'=>$data['account']])->first();
            if($admin_user==null){
                $a='该账户不存在';
            }else{
                if(Hash::check($data['pwd'],$admin_user['pwd'])){
                    session(['admin'=>$admin_user->toArray()]);
                    return redirect('admin/index/welcome');
                }else{
                    $a='密码错误';
                }
            }
        }
        return view('admin.login.login',['message'=>$a]);
    }

    //实现退出
    public function login_out(Request $request){
        $request->session()->forget('admin');
        return redirect('admin/login');
    }

    //实现管理头像图片上传
    public function user_avatar(Request $request){
        $file = $request->file('avatar1');
        $member = new Login();
        $url = $member->user_avatar($file);
        if($url==null){
            return ['ret'=>0,'message'=>'上传图片失败','data'=>$url];
        }else{
            return ['ret'=>200,'message'=>'上传图片成功','data'=>$url];
        }
    }

    //实现修改管理头像和座右铭
    public function admin_edit(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'id'=>'required',
            'pic'=>'required',
            'motto'=>'required',
        ],[
            'id.required'=>'数据异常',
            'pic.required'=>'请上传头像',
            'motto.required'=>'请填写座右铭',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $admin_edit = new Login();
            $a = $admin_edit->admin_edit($data);
            if($a === true){
                return ['ret'=>200,'message'=>'设置成功'];
            }
        }
    }
}