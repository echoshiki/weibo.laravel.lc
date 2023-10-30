<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Arg;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'StaticPagesController@home');
Route::get('/about', 'StaticPagesController@about');

Route::resource('users', 'UsersController');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');

// Route::get('logout', 'SessionsController@destroy')->name('logout');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

# 激活用户
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

# 忘记密码
Route::get('password/reset', 'PasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'PasswordController@sendResetLinkEmail')->name('password.email');

# 重置密码
Route::get('password/reset/{token}', 'PasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'PasswordController@reset')->name('password.update');

# 发布/删除微博
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);

# 粉丝列表 & 关注列表
Route::get('users/{user}/followers', 'UsersController@followers')->name('users.followers');
Route::get('users/{user}/followings', 'UsersController@followings')->name('users.followings');

# 关注 & 取消关注 逻辑
Route::post('users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');