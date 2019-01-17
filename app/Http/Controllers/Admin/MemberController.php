<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/14
 * Time: 11:48
 */

namespace App\Http\Controllers\Admin;


use App\Common\Admin\Member;
use App\Http\Controllers\Controller;
use App\Model\Member_grade;
use App\Model\Member_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * 显示会员用户管理
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user(){
        $member = new Member();
        $a = $member->user();
        return view('admin.member.user',['user'=>$a]);
    }

    /**
     * 实现图片上传
     * @param Request $request
     * @return array
     */
    public function user_avatar(Request $request){
        $file = $request->file('avatar1');
        $member = new Member();
        $url = $member->user_avatar($file);
        if($url==null){
            return ['ret'=>0,'message'=>'上传图片失败','data'=>$url];
        }else{
            return ['ret'=>200,'message'=>'上传图片成功','data'=>$url];
        }

    }

    /**
     * 实现用户添加
     * @param Request $request
     * @return array
     */
    public function user_add(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'avatar'=>'required',
            'account'=>'required|unique:member_user',
            'password'=>'required',
        ],[
            'avatar.required'=>'请上传头像图片',
            'account.required'=>'请填写用户账号名称',
            'account.unique'=>'该用户账号名称已存在',
            'password.required'=>'请填写用户账号密码',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $member = new Member();
            $a = $member->user_add($data);
            if($a === true){
                return ['ret'=>200,'message'=>'添加用户成功'];
            }
        }
    }

    /**显示用户详情页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user_list(Request $request){
        $id = $request->input('id');
        $member = new Member();
        $a = $member->user_list($id);
        return view('admin.member.user_list',['user'=>$a]);
    }

    /**
     * 通过用户id查询用户信息
     * @param Request $request
     * @return array
     */
    public function user_show(Request $request){
        $id = $request->post('id');
        $member = new Member();
        $a = $member->user_list($id);
        return ['ret'=>200,'data'=>$a];
    }

    /**
     * 修改用户资料
     * @param Request $request
     * @return array
     */
    public function user_edit(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'nickname'=>'required',
            'sex'=>'required',
            'phone'=>'required',
        ],[
            'nickname.required'=>'请填写用户昵称',
            'sex.required'=>'请填写用户性别',
            'phone.required'=>'请填写用户手机号码',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $member = new Member();
            $a = $member->user_edit($data);
            if($a == true){
                return ['ret'=>200,'message'=>'修改用户资料成功'];
            }
        }
    }

    /**
     * 通过用户id查询用户会员等级id
     * @param Request $request
     * @return array
     */
    public function user_grade_show(Request $request){
        $id = $request->post('id');
        $member = new Member();
        $a = $member->user_grade_show($id);
        $b = $member->user_grade();
//        dd($b);
        return ['ret'=>200,'data'=>$b,'grade_id'=>$a];
    }

    /**
     * 修改用户密码
     * @param Request $request
     * @return array
     */
    public function user_password_edit(Request $request){
        $data = $request->post();
        $user = Member_user::where(['id'=>$data['id']])->first();
        if(Hash::check($data['password1'],$user['password'])){
            if($data['password2']==null){
                return ['ret'=>0,'message'=>'请输入新密码'];
            }else{
                $member = new Member();
                $a = $member->user_password_edit($data);
                if($a == true){
                    return ['ret'=>'200','message'=>'修改用户密码成功'];
                }
            }
        }else{
            return ['ret'=>0,'message'=>'原密码错误'];
        }
    }

    /**
     * 修改用户会员等级
     * @param Request $request
     * @return array
     */
    public function user_grade_edit(Request $request){
        $data = $request->post();
        if($data['grade_id']==null){
            return ['ret'=>0,'message'=>'请选择会员等级'];
        }
        $grade = Member_grade::where(['id'=>$data['grade_id']])->first();
        if($grade==null){
            return ['ret'=>0,'message'=>'该会员等级不存在'];
        }
        else{
            $member = new Member();
            $a = $member->user_grade_edit($data);
            if($a == true){
                return ['ret'=>200,'message'=>'修改会员等级成功'];
            }
        }
    }

    /**
     * 修改会员余额
     * @param Request $request
     * @return array
     */
    public function user_money(Request $request){
        $data = $request->post();
        if($data['money']==null){
            return ['ret'=>0,'message'=>'请填写会员余额'];
        }
        $member = new Member();
        $a = $member->user_money($data);
        if($a == true){
            return ['ret'=>200,'message'=>'修改会员余额成功'];
        }
    }

    /**
     * 删除用户
     * @param Request $request
     * @return array
     */
    public function user_del(Request $request){
        $id = $request->post('id');
        $member = new Member();
        $a = $member->user_del($id);
        if($a == true){
            return ['ret'=>200,'message'=>'删除用户成功'];
        }
    }

    /**显示会员等级管理页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function grade(){
        $member = new Member();
        $a = $member->grade();
        return view('admin.member.grade',['grade'=>$a]);
    }

    /**
     * 实现会员等级添加
     * @param Request $request
     * @return array
     */
    public function grade_add(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'name'=>'required|unique:member_grade',
            'condition'=>'required',
            'discount'=>'required',
        ],[
            'name.required'=>'请填写会员等级名称',
            'name.unique'=>'该会员等级名称已存在',
            'condition.required'=>'请填写会员等级升级条件',
            'discount.required'=>'请填写会员折扣',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            if($data['discount']>=1){
                return ['ret'=>0,'message'=>'折扣值不能超过1'];
            }
            $member = new Member();
            $a = $member->grade_add($data);
            if($a == true){
                return ['ret'=>200,'message'=>'添加会员等级成功'];
            }
        }
    }

    /**
     * 通过id查找会员等级信息
     * @param Request $request
     * @return array
     */
    public function grade_show(Request $request){
        $id = $request->post('id');
        $member = new Member();
        $a = $member->grade_show($id);
        return ['ret'=>200,'data'=>$a];
    }

    /**
     * 实现会员等级修改
     * @param Request $request
     * @return array
     */
    public function grade_edit(Request $request){
        $data = $request->post();
        $id = $data['id'];
        $member = new Member();
        $members = $member->grade_show($id);
        if($data['name']==$members['name']){
            $validator = Validator::make($data,[
                'name'=>'required',
                'condition'=>'required',
                'discount'=>'required',
            ],[
                'name.required'=>'请填写会员等级名称',
                'condition.required'=>'请填写会员等级升级条件',
                'discount.required'=>'请填写会员折扣',
            ]);
            if($validator->fails()){
                $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
                $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
                return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
            }else{
                if($data['discount']>=1){
                    return ['ret'=>0,'message'=>'折扣值不能超过1'];
                }
                $a = $member->grade_edit($data);
                if($a == true){
                    return ['ret'=>200,'message'=>'修改会员等级成功'];
                }
            }
        }
        $validator = Validator::make($data,[
            'name'=>'required|unique:member_grade',
            'condition'=>'required',
            'discount'=>'required',
        ],[
            'name.required'=>'请填写会员等级名称',
            'name.unique'=>'该会员等级名称已存在',
            'condition.required'=>'请填写会员等级升级条件',
            'discount.required'=>'请填写会员折扣',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            if($data['discount']>=1){
                return ['ret'=>0,'message'=>'折扣值不能超过1'];
            }
            $a = $member->grade_edit($data);
            if($a == true){
                return ['ret'=>200,'message'=>'修改会员等级成功'];
            }
        }
    }

    /**
     * 实现会员等级删除
     * @param Request $request
     * @return array
     */
    public function grade_del(Request $request){
        $id = $request->post('id');
        $member = new Member();
        $a = $member->grade_del($id);
        if($a == true){
            return ['ret'=>200,'message'=>'删除会员等级成功'];
        }
    }
}