<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5
 * Time: 15:30
 */

namespace App\Http\Controllers\Admin;


use App\Common\Admin\Notice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class NoticeController extends Controller
{
    /**
     * 显示公告栏目管理
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function column_index(){
        $notice = new Notice();
        $a = $notice->column_index();
        return view('admin.notice.column_index',['column'=>$a]);
    }

    /**
     * 实现公告栏目添加
     * @param Request $request
     * @return array
     */
    public function column_add(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'name'=>'required|unique:notice_column',
        ],[
            'name.required'=>'请填写公告栏目名称',
            'name.unique'=>'该公告栏目名称已存在',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $notice = new Notice();
            $a = $notice->column_add($data);
            if($a===true){
                return ['ret'=>200,'message'=>'公告栏目名称添加成功！'];
            }
        }
    }

    /**
     * 实现公告栏目单记录查询
     * @param Request $request
     * @return array
     */
    public function column_show(Request $request){
        $data = $request->post();
        if($data['id']==null){
            return ['ret'=>0,'message'=>'未获取到id值'];
        }else{
            $notice = new Notice();
            $a = $notice->column_show($data['id']);
            if(!$a==null){
                return ['ret'=>200,'data'=>$a];
            }
        }
    }

    /**
     * 实现公告栏目修改
     * @param Request $request
     * @return array
     */
    public function column_edit(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'name'=>'required|unique:notice_column',
        ],[
            'name.required'=>'请填写公告栏目名称',
            'name.unique'=>'该公告栏目名称已存在',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $notice = new Notice();
            $a = $notice->column_edit($data);
            if($a === true){
                return ['ret'=>200,'message'=>'公告栏目名称修改成功！'];
            }
        }
    }

    /**
     * 删除公告栏目以及该栏目下的所有公告文章
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function column_del(Request $request){
        $id = $request->post('id');
        $notice = new Notice();
        $notice->column_del($id);
        return ['ret'=>200,'message'=>'删除公告栏目成功'];
    }

    /**
     * 显示分类下的公告文章管理
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article_indexs($id){
        $notice = new Notice();
        $a = $notice->article_index($id);
        return view('admin.notice.article_index',['article'=>$a]);
    }

    /**
     * 显示文章管理页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article_index(){
        $notice = new Notice();
        $a = $notice->article_index();
//        dd($a);
        return view('admin.notice.article_index',['article'=>$a['a'],'article0'=>$a['b'],'article1'=>$a['c']]);
    }

    /**
     * 显示文章添加页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article_adds(){
        $notice = new Notice();
        $a = $notice->article_column();
        return view('admin.notice.article_adds',['column'=>$a]);
    }

    /**
     * 实现文章添加
     * @param Request $request
     * @return array
     */
    public function article_add(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'title'=>'required|unique:notice_article',
            'column_id'=>'required',
            'synopsis'=>'required',
            'content'=>'required',
            'status'=>'required',
        ],[
            'title.required'=>'请填写公告文章标题',
            'title.unique'=>'该公告文章标题已存在',
            'column_id.required'=>'请选择公告文章所属栏目',
            'synopsis.required'=>'请填写公告文章简介',
            'content.required'=>'请填写公告文章内容',
            'status.required'=>'请选择公告文章状态',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $notice = new Notice();
            $a = $notice->article_add($data);
            if($a === true){
                return ['ret'=>200,'message'=>'公告文章添加成功！'];
            }
        }
    }

    /**实现文章状态修改
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article_status(Request $request){
        $id = $request->input('id');
        $notice = new Notice();
        $a = $notice->article_status($id);
        if($a === true){
            $b = $notice->article_index($id);
            return view('admin.notice.article_index',['article'=>$b['a'],'article0'=>$b['b'],'article1'=>$b['c']]);
        }
    }

    /**文章单记录查询，显示文章修改页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article_edits(Request $request){
        $id = $request->input('id');
        $notice = new Notice();
        $a = $notice->article_show($id);
        $b = $notice->article_column();
        return view('admin.notice.article_edits',['article'=>$a,'column'=>$b]);
    }

    /**
     * 实现文章修改
     * @param Request $request
     * @return array
     */
    public function article_edit(Request $request){
        $data = $request->post();
        $validator = Validator::make($data,[
            'title'=>'required|unique:notice_article',
            'column_id'=>'required',
            'synopsis'=>'required',
            'content'=>'required',
            'status'=>'required',
        ],[
            'title.required'=>'请填写公告文章标题',
            'title.unique'=>'该公告文章标题已存在',
            'column_id.required'=>'请选择公告文章所属栏目',
            'synopsis.required'=>'请填写公告文章简介',
            'content.required'=>'请填写公告文章内容',
            'status.required'=>'请选择公告文章状态',
        ]);
        if($validator->fails()){
            $warnings = $validator->messages();//获取验证未通过的错误提示信息，赋值给变量$warnings
            $show_warnings = $warnings->first();//获取$warnings中的第一条记录赋值给变量$show_warnings
            return ['ret'=>0,'message'=>$show_warnings];//返回状态为0，data为变量$show_warnings的数组给前端
        }else{
            $notice = new Notice();
            $a = $notice->article_edit($data);
            if($a === true){
                return ['ret'=>200,'message'=>'公告文章修改成功！'];
            }
        }
    }

    /**
     * 实现文章删除
     * @param Request $request
     * @return array
     */
    public function article_del(Request $request){
        $id = $request->post('id');
        $notice = new Notice();
        $a = $notice->article_del($id);
        if($a === true){
            return ['ret'=>200,'message'=>'删除文章成功'];
        }

    }
}