<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

\Illuminate\Support\Facades\Route::any('admin/login','Admin\LoginController@login_list');//显示登陆页面
\Illuminate\Support\Facades\Route::any('admin/login_out','Admin\LoginController@login_out');//实现退出
\Illuminate\Support\Facades\Route::any('admin/user_avatar','Admin\LoginController@user_avatar');//实现管理头像上传
\Illuminate\Support\Facades\Route::any('admin/admin_edit','Admin\LoginController@admin_edit');//实现设置
\Illuminate\Support\Facades\Route::view('admin/404', 'admin.base.404');;//显示404页面

\Illuminate\Support\Facades\Route::namespace('Admin')->middleware('admin.auth')->prefix('admin')->group(function () { // 在 "App\Http\Controllers\Admin" 命名空间下的控制器
//        ->middleware('admin.auth')

    /**
     * 首页全部路由
     */
    //首页路由
    \Illuminate\Support\Facades\Route::get('index/welcome','IndexController@index');//显示首页


    /**
     * 公告管理全部路由
     */
    //公告栏目路由
    \Illuminate\Support\Facades\Route::get('notice/column_index','NoticeController@column_index');//显示栏目管理页面
    \Illuminate\Support\Facades\Route::post('notice/column_add','NoticeController@column_add');//添加栏目
    \Illuminate\Support\Facades\Route::post('notice/column_show','NoticeController@column_show');//单栏目查询
    \Illuminate\Support\Facades\Route::post('notice/column_edit','NoticeController@column_edit');//修改栏目
    \Illuminate\Support\Facades\Route::post('notice/column_del','NoticeController@column_del');//删除栏目
    //公告文章路由
    \Illuminate\Support\Facades\Route::get('notice/article_index','NoticeController@article_index');//显示文章管理页面
    \Illuminate\Support\Facades\Route::get('notice/article_adds','NoticeController@article_adds');//显示添加文章页面
    \Illuminate\Support\Facades\Route::post('notice/article_add','NoticeController@article_add');//添加文章
    \Illuminate\Support\Facades\Route::get('notice/article_status','NoticeController@article_status');//修改状态
    \Illuminate\Support\Facades\Route::get('notice/article_edits','NoticeController@article_edits');//显示修改文章页面
    \Illuminate\Support\Facades\Route::post('notice/article_edit','NoticeController@article_edit');//修改文章
    \Illuminate\Support\Facades\Route::post('notice/article_del','NoticeController@article_del');//删除文章


    /**
     * 会员管理全部路由
     */
    //会员用户管理路由
    \Illuminate\Support\Facades\Route::get('member/user','MemberController@user');//显示会员用户管理页面
    \Illuminate\Support\Facades\Route::post('member/user_avatar','MemberController@user_avatar');//上传用户头像
    \Illuminate\Support\Facades\Route::post('member/user_add','MemberController@user_add');//添加会员用户
    \Illuminate\Support\Facades\Route::get('member/user_list','MemberController@user_list');//显示会员用户详情
    \Illuminate\Support\Facades\Route::post('member/user_show','MemberController@user_show');//查询会员用户资料
    \Illuminate\Support\Facades\Route::post('member/user_edit','MemberController@user_edit');//修改会员用户资料
    \Illuminate\Support\Facades\Route::post('member/user_grade_show','MemberController@user_grade_show');//查询会员用户等级
    \Illuminate\Support\Facades\Route::post('member/user_password_edit','MemberController@user_password_edit');//修改会员用户密码
    \Illuminate\Support\Facades\Route::post('member/user_grade_edit','MemberController@user_grade_edit');//修改会员用户等级
    \Illuminate\Support\Facades\Route::post('member/user_money','MemberController@user_money');//修改会员用户余额
    \Illuminate\Support\Facades\Route::post('member/user_del','MemberController@user_del');//删除会员用户
    //会员等级管理路由
    \Illuminate\Support\Facades\Route::get('member/grade','MemberController@grade');//显示会员登记管理
    \Illuminate\Support\Facades\Route::post('member/grade_add','MemberController@grade_add');//实现会员等级添加
    \Illuminate\Support\Facades\Route::post('member/grade_show','MemberController@grade_show');//实现会员等级修改
    \Illuminate\Support\Facades\Route::post('member/grade_edit','MemberController@grade_edit');//实现会员等级修改
    \Illuminate\Support\Facades\Route::post('member/grade_del','MemberController@grade_del');//实现会员等级删除


    /**
     * 商品管理全部路由
     */
    //商品页面管理路由
    \Illuminate\Support\Facades\Route::get('goods/index','GoodsController@index');//显示商品管理页面
    //商品分类管理路由
    \Illuminate\Support\Facades\Route::post('goods/category_add','GoodsController@category_add');//实现商品类别添加
    \Illuminate\Support\Facades\Route::post('goods/category_show','GoodsController@category_show');//实现商品类别单记录查询
    \Illuminate\Support\Facades\Route::post('goods/category_edit','GoodsController@category_edit');//实现商品类别修改
    \Illuminate\Support\Facades\Route::post('goods/category_del','GoodsController@category_del');//实现商品类别删除
    //商品信息管理路由
    \Illuminate\Support\Facades\Route::get('goods/message_add','GoodsController@message_add');//显示商品信息添加页面
    \Illuminate\Support\Facades\Route::post('goods/goods_pic','GoodsController@goods_pic');//商品主图上传
    \Illuminate\Support\Facades\Route::post('goods/message_adds','GoodsController@message_adds');//实现商品添加
    \Illuminate\Support\Facades\Route::get('goods/message_status','GoodsController@message_status');//实现商品状态修改
    \Illuminate\Support\Facades\Route::get('goods/message_edit','GoodsController@message_edit');//显示商品信息修改页面
    \Illuminate\Support\Facades\Route::post('goods/message_update','GoodsController@message_update');//实现商品信息修改
    \Illuminate\Support\Facades\Route::post('goods/message_del','GoodsController@message_del');//实现商品信息删除


    /**
     * 管理员管理全部路由
     */
    //管理员权限管理路由
    \Illuminate\Support\Facades\Route::get('admin_user/jurisdiction','AdminUserController@jurisdiction');//显示权限管理页面
    \Illuminate\Support\Facades\Route::post('admin_user/jurisdiction_add','AdminUserController@jurisdiction_add');//实现管理权限添加
    \Illuminate\Support\Facades\Route::post('admin_user/jurisdiction_show','AdminUserController@jurisdiction_show');//实现管理权限单记录查询
    \Illuminate\Support\Facades\Route::post('admin_user/jurisdiction_edit','AdminUserController@jurisdiction_edit');//实现管理权限修改
    \Illuminate\Support\Facades\Route::post('admin_user/jurisdiction_del','AdminUserController@jurisdiction_del');//实现管理权限删除
    //管理员信息管理
    \Illuminate\Support\Facades\Route::get('admin_user/admin_user','AdminUserController@admin_user');//显示管理员管理页面
    \Illuminate\Support\Facades\Route::get('admin_user/admin_add','AdminUserController@admin_add');//显示管理员添加页面
    \Illuminate\Support\Facades\Route::post('admin_user/admin_adds','AdminUserController@admin_adds');//实现管理员添加
    \Illuminate\Support\Facades\Route::get('admin_user/admin_edit/{id}','AdminUserController@admin_edit');//显示管理员修改页面
    \Illuminate\Support\Facades\Route::post('admin_user/admin_edits','AdminUserController@admin_edits');//显示商品信息修改页面
    \Illuminate\Support\Facades\Route::post('admin_user/admin_del','AdminUserController@admin_del');//实现商品信息删除

});