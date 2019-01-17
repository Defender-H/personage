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

\Illuminate\Support\Facades\Route::view('mobile/base/search', 'mobile.base.search');;//显示搜索页面
\Illuminate\Support\Facades\Route::view('mobile/home/index', 'mobile.home.index');;//显示首页页面
\Illuminate\Support\Facades\Route::view('mobile/classify/index', 'mobile.classify.index');;//显示分类页面
\Illuminate\Support\Facades\Route::view('mobile/user/index', 'mobile.user.index');;//显示用户页面

\Illuminate\Support\Facades\Route::namespace('Mobile')->prefix('mobile')->group(function () { // 在 "App\Http\Controllers\Admin" 命名空间下的控制器
//        ->middleware('admin.auth')



});