<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 9:14
 */

namespace App\Common\Admin;


use App\Model\Admin_jurisdiction;

class AuthAdmin
{
    public function AuthAdmin($admin,$url){
        $admin_jurisdiction = Admin_jurisdiction::whereIn('id',json_decode($admin['jurisdiction_id']))->get()->toArray();//查找出当前登陆用户所拥有权限的路由
        foreach($admin_jurisdiction as $v){
            if ($url==$v['url']){
                $a = true;
                return $a;
                break;
            }else{
                $a = false;
            }
        }
        return $a;
    }
}