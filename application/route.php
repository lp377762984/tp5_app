<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
//
Route::rule('abc/:name','index/Login/login');
Route::rule('register','index/Index/register');
Route::rule('login','index/Index/login');
Route::rule('userInfo','index/Index/userInfo');
Route::rule('uploadsPortrait','index/Index/uploadsPortrait');

