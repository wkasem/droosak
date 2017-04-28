<?php

Route::get('/' , 'adminController@index')->name('admin.index');
Route::post('/usersChart' , 'adminController@getUsersChart');
Route::post('/revenueChart' , 'adminController@getRevenueChart');
Route::post('/subscribers' , 'adminController@getSubscribers');
Route::post('/live' , 'adminController@live');
Route::post('/introSave' , 'adminController@introSave');
Route::post('/adsSave' , 'adminController@adsSave');
Route::post('/logo' , 'adminController@logoSave');
Route::post('/font/upload' , 'adminController@uploadFont');


Route::post('/documents/upload' , 'DocumentsController@upload');
Route::post('/documents/delete' , 'DocumentsController@delete');


//Videos
Route::group(['prefix' => '/courses'],function(){

  Route::get('/' , 'VideoController@index')->name('admin.playlists');
  Route::get('/{id}/videos' , 'VideoController@getPlaylist');
  Route::post('/{id}/upload' , 'VideoController@uploadVideo');
  Route::post('/{id}/edit' , 'VideoController@updateVideo');
  Route::post('/{id}/delete' , 'VideoController@deleteVideo');
  Route::post('/add-playlist' , 'VideoController@addPlaylist');
  Route::post('/{id}/poster' , 'VideoController@updatePoster');
  Route::post('/live/create' , 'StreamController@adminOn');
});

Route::group(['prefix' => '/exams'],function(){

  Route::get('/' , 'ExamsController@index')->name('admin.exams');
  Route::get('/{exam}' , 'ExamsController@edit')->name('admin.exams.edit');
  Route::post('/save' , 'ExamsController@save');
  Route::post('/create' , 'ExamsController@createExam')->name('createExam');
});


Route::group(['prefix' => '/schedule'],function(){

  Route::get('/' , 'ScheduleController@index')->name('admin.schedule');
  Route::post('/save' , 'ScheduleController@save');
});



Route::group(['prefix' => '/teachers'],function(){

  Route::get('/' , 'TeachersController@index')->name('admin.teachers');
  Route::post('/add' , 'TeachersController@add');
  Route::post('/delete/cv' , 'TeachersController@deleteCV');
});

Route::group(['prefix' => '/students'],function(){

  Route::get('/' , 'StudentsController@index')->name('admin.students');
  Route::post('/points/update' , 'StudentsController@updatePoints');
});
