<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/14
 * Time: 11:39
 */

namespace App\Common\Admin;


use App\Model\Member_grade;
use App\Model\Member_user;
use Illuminate\Support\Facades\Hash;

class Member
{
    /**
     * 查询出全部会员用户，并分页
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function user(){
        $a = Member_user::select()
            ->orderBy('created_at','desc')
            ->paginate(15);
        return $a;
    }

    /**
     * 实现用户头像上传
     * @param $avatar
     * @return string
     */
    public function user_avatar($avatar){
        $path = $avatar->store('avatar','public');
        $url = '/storage/'.$path;
        return $url;
    }

    /**
     * 实现用户添加
     * @param $data
     * @return bool
     */
    public function user_add($data){
        Member_user::create([
            'avatar'=>$data['avatar'],
            'account'=>$data['account'],
            'grade_id'=>8,
            'password'=>Hash::make($data['password']),
        ]);
        return true;
    }

    /**
     * 通过用户id查询用户信息
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function user_list($id){
        $a = Member_user::where(['id'=>$id])->first();
        return $a;
    }

    /**
     * 修改用户资料
     * @param $data
     * @return bool
     */
    public function user_edit($data){
        if($data['avatar']==null){
            Member_user::where(['id'=>$data['id']])->update([
                'nickname'=>$data['nickname'],
                'sex'=>$data['sex'],
                'phone'=>$data['phone'],
            ]);
            return true;
        }
        else{
            Member_user::where(['id'=>$data['id']])->update([
                'avatar'=>$data['avatar'],
                'nickname'=>$data['nickname'],
                'sex'=>$data['sex'],
                'phone'=>$data['phone'],
            ]);
            return true;
        }
    }

    /**
     * 通过用户id查询用户会员等级id
     * @param $id
     * @return mixed
     */
    public function user_grade_show($id){
        $a = Member_user::where(['id'=>$id])->first();
        return $a;
    }

    /**
     * 查询出全部会员等级
     * @return $this
     */
    public function user_grade(){
        $a = Member_grade::all()->toArray();
        return $a;
    }

    /**
     * 修改用户密码
     * @param $data
     * @return bool
     */
    public function user_password_edit($data){
        Member_user::where(['id'=>$data['id']])->update(['password'=>Hash::make($data['password2'])]);
        return true;
    }

    /**
     * 修改用户会员等级
     * @param $data
     * @return bool
     */
    public function user_grade_edit($data){
        Member_user::where(['id'=>$data['id']])->update(['grade_id'=>$data['grade_id']]);
        return true;
    }

    /**
     * 修改会员余额
     * @param $data
     * @return bool
     */
    public function user_money($data){
        Member_user::where(['id'=>$data['id']])->update(['money'=>$data['money']]);
        return true;
    }

    /**
     * 删除用户
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function user_del($id){
        Member_user::where(['id'=>$id])->delete();
        return true;
    }

    /**
     * 查询会员等级记录，按时间排序，分页
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function grade(){
        $a = Member_grade::select()
            ->orderBy('created_at')
            ->paginate(15);
        return $a;
    }

    /**
     * 实现会员等级添加
     * @param $data
     * @return bool
     */
    public function grade_add($data){
        Member_grade::create([
            'name'=>$data['name'],
            'condition'=>$data['condition'],
            'discount'=>$data['discount']
        ]);
        return true;
    }

    /**
     * 通过id查找会员等级信息
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function grade_show($id){
        $a = Member_grade::where(['id'=>$id])->first();
        return $a;
    }

    /**
     * 实现会员等级修改
     * @param $data
     * @return bool
     */
    public function grade_edit($data){
        Member_grade::where(['id'=>$data['id']])->update([
            'name'=>$data['name'],
            'condition'=>$data['condition'],
            'discount'=>$data['discount']
        ]);
        return true;
    }

    /**
     * 实现会员等级删除
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function grade_del($id){
        Member_grade::where(['id'=>$id])->delete();
        return true;
    }
}