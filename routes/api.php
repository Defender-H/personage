<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

\Illuminate\Support\Facades\Route::namespace('Api')->group(function () { // 在 "App\Http\Controllers\Api" 命名空间下的控制器
    \Illuminate\Support\Facades\Route::get('goods/commodity_column','CommodityController@commodity_column');//显示首页
});

