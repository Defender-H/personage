<?php

namespace App\Http\ViewComposers;


use App\Http\Controllers\Controller;
use App\Model\Admin_jurisdiction;
use App\Model\Admin_user;
use Illuminate\View\View;//**记得引入这个啊（因为在composer函数参数里使用了View类）**

class ProfileComposer extends Controller
{
    public $movieList = [];
    public function __construct()
    {
        $this->movieList = [
            'Shawshank redemption',
            'Forrest Gump',
        ];
    }
    public function compose(View $view)
    {
        $admin = session('admin');
        $data = Admin_jurisdiction::groupBy('module')->get()->toArray();
        for($i=0;$i<count($data);$i++){
            $admin_jurisdiction[$i] = Admin_jurisdiction::whereIn('id',json_decode($admin['jurisdiction_id']))
                ->where(['module'=>$data[$i]['module']])
                ->get()->toArray();//查找出当前登陆用户所拥有权限的路由
            $admin_jurisdiction1[$i] = Admin_jurisdiction::where(['module'=>$data[$i]['module']])
                ->get()->toArray();//查找出当前登陆用户所拥有权限的路由
            $count[$i] = count($admin_jurisdiction[$i]);
            $count1[$i] = count( $admin_jurisdiction1[$i]);
            $aa[$data[$i]['module']] = round( $count[$i]/$count1[$i]*100);
        }
        $pic = Admin_user::where(['id'=>$admin['id']])->first();
        $view->with('admin_pic',$pic['pic']);
        $view->with('admin_motto',$pic['motto']);
        $view->with('admin_jurisdiction',$aa);
    }
}