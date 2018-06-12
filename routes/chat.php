<?php



Route::get('/chat',function (){
    return view('chat.index');
});


/** Home Route **/
Route::namespace('Chat\Home')->group(function () {
    Route::post('chat/login','IndexController@login')->name('login');  //login 认证
    Route::post('chat/upload','IndexController@upload')->name('upload');  //图片上传
    Route::post('chat/getPacket','IndexController@getPacket')->name('getPacket');  //拆红包
    Route::post('chat/updateUserNick','UserController@userNick'); //修改昵称
    Route::post('chat/avatarUpload','UserController@userAvatar'); //上传头像
});


/** Backend Route **/
Route::prefix('src-back')->namespace('Chat\Backend')->group(function () {
    Route::get('/', 'IndexController@index')->name('chat');
    Route::post('/auth/login', 'AuthController@login');            //login
    Route::get('/auth/check', 'AuthController@checkUser');         // check session
    Route::post('/auth/setting', 'AuthController@setting');         // update users password
    Route::post('/auth/logout', 'AuthController@logout');           //logout

    Route::resource('/user', 'UserController');                     //用户管理
    Route::resource('/role', 'RoleController');                     //角色管理
    Route::resource('/admin', 'AdminController');                   //管理员管理
    Route::resource('/bullet', 'BulletController');                 //公告管理
    Route::resource('/room', 'RoomController');                     //房间管理
    Route::post('/room/disable/{id}','RoomController@disable')->name('room.disable');  //房间禁言
    Route::resource('/disable','DisableController');                //违禁词管理
    Route::resource('/packet','PacketController');                  //红包管理
    Route::post('/packet/{id}', 'PacketController@disable')->name('packet.disable');  //关闭红包
    Route::resource('/record','RecordController');                  //红包明细
    Route::post('/record/editAll', 'RecordController@editAll')->name('record.editAll');  //一键补发
    Route::resource('/platcfg','PlatcfgController');                  //平台配置

});
