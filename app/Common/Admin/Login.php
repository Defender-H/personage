<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/24
 * Time: 14:21
 */

namespace App\Common\Admin;


use App\Model\Admin_user;

class Login
{
    //实现管理员头像上传
    public function user_avatar($avatar){
        $path = $avatar->store('admin/admin_avatar','public');
        $url = '/storage/'.$path;
        return $url;
    }

    //实现修改管理员头像，管理员座右铭
    public function admin_edit($data){
        Admin_user::where(['id'=>$data['id']])->update([
            'pic'=>$data['pic'],
            'motto'=>$data['motto'],
        ]);
        return true;
    }
}