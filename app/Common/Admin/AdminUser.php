<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/6
 * Time: 9:15
 */

namespace App\Common\Admin;


use App\Model\Admin_jurisdiction;
use App\Model\Admin_user;
use Illuminate\Support\Facades\Hash;

class AdminUser
{
    /**
     * 权限表数据全部查询，并分页显示
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function jurisdiction(){
        $a = Admin_jurisdiction::select()
            ->orderBy('name')
            ->paginate(6);
        return $a;
    }

    /**
     * 实现权限数据的增加
     * @param $data
     * @return bool
     */
    public function jurisdiction_add($data){
        Admin_jurisdiction::create([
            'name'=>$data['name'],
            'url'=>$data['url'],
        ]);
        return true;
    }

    /**
     * 实现管理权限单记录查询
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function jurisdiction_show($id){
        $a = Admin_jurisdiction::where(['id'=>$id])->first();
        return $a;
    }

    /**
     * 实现管理权限修改
     * @param $data
     * @return bool
     */
    public function jurisdiction_edit($data){
        Admin_jurisdiction::where(['id'=>$data['id']])->update([
            'name'=>$data['name'],
            'url'=>$data['url'],
        ]);
        return true;
    }

    /**
     * 实现管理权限删除
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function jurisdiction_del($id){
        Admin_jurisdiction::where(['id'=>$id])->delete();
        return true;
    }

    /**
     * 查询所有管理员数据
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function admin_user(){
        $a = Admin_user::select()
            ->orderBy('name')
            ->paginate(6);
        return $a;
    }

    /**
     * 查询全部管理权限
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function admin_jurisdiction_show(){
        $a = Admin_jurisdiction::all();
        return $a;
    }

    /**
     * 实现管理员添加
     * @param $data
     * @return bool
     */
    public function admin_adds($data){
        $a = json_encode($data['check_val']);
        Admin_user::create(['name'=>$data['name'],'describe'=>$data['describe'],'jurisdiction_id'=>$a,'pwd'=>Hash::make($data['pwd1']),'account'=>$data['account']]);
        return true;
    }

    /**
     * 实现管理员单记录查询
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function admin_edit($id){
        $a = Admin_user::where(['id'=>$id])->first();
        return $a;
    }

    /**
     * 实现管理员修改
     * @param $data
     * @return bool
     */
    public function admin_edits($data){
        $a = json_encode($data['check_val']);
        Admin_user::where(['id'=>$data['id']])->update([
            'name'=>$data['name'],
            'describe'=>$data['describe'],
            'jurisdiction_id'=>$a,
        ]);
        return true;
    }

    /**实现管理员删除
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function admin_del($id){
        Admin_user::where(['id'=>$id])->delete();
        return true;
    }

}