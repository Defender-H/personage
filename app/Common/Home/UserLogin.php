<?php

namespace App\Common\Home;
use App\Model\Member_user;
use Illuminate\Support\Facades\Validator;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/20
 * Time: 15:01
 */
class UserLogin
{
    //用户注册方法
    public function user_register($data){
        Member_user::create([
            'account'=>$data['account'],
            'grade_id'=>8,
            'password'=>Hash::make($data['password']),
        ]);
        return true;
    }
}