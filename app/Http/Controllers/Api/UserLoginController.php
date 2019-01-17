<?php

namespace App\Http\Controllers\Api;
use App\Common\Home\UserLogin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/20
 * Time: 15:15
 */
class UserLoginController extends Controller
{
    //用户注册
    public function user_register(Request $request){
        echo 123;
        dd(123);
        $data = $request->post();
        $validator = Validator::make($data,[
            'account'=>'required|unique:member_user',
            'password'=>'required',
        ],[
            'account.required'=>'请填写用户账号名称',
            'account.unique'=>'该用户账号名称已存在',
            'password.required'=>'请填写用户账号密码',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $user_login = new UserLogin();
            $a = $user_login->user_register($data);
            if($a === true){
                return ['ret'=>200,'message'=>'添加用户成功'];
            }
        }
    }
}