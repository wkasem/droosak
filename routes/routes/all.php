<?php

Route::get('video/{id}/getThumb' , 'VideoController@getThumb');
Route::get('video/{id}/stream' , 'VideoController@streamVideo')->name('home.video.stream');
Route::get('video/{id}' , 'VideoController@getVideo')->name('home.video');
Route::post('/comment' , 'CommentController@addComment');
Route::post('/comments/more' , 'CommentController@moreComments');
Route::post('/replies/more' , 'CommentController@moreReplies');
Route::post('/comment/sendVoiceNote' , 'CommentController@sendVoiceNote');
Route::get('/voiceNote/{src}/stream' , 'MessagesController@streamVoiceNote');

Route::get('profile/{id}' , 'TeachersController@getTeacher');


Route::group(['prefix' => '/messages'],function(){

  Route::get('/{id?}' , 'MessagesController@index')->name('messages');
  Route::post('/send' , 'MessagesController@sendMessage');
  Route::post('/markAsSeen' , 'MessagesController@markAsSeen');
  Route::post('/sendVoiceNote' , 'MessagesController@sendVoiceNote');
});


Route::get('/settings' , 'SettingsController@index')->name('settings');
Route::get('/pic/{id}' , 'SettingsController@getPic')->name('profilePic');
Route::post('/settings/pic' , 'SettingsController@uploadPic')->name('settings.pic');
Route::post('/settings/username' , 'SettingsController@username')->name('settings.username');

Route::get('/search' , 'HomeController@search')->name('search');
