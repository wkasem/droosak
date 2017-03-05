<?php

Route::get('/' , 'adminController@index')->name('admin.index');
Route::post('/usersChart' , 'adminController@getUsersChart');
Route::post('/revenueChart' , 'adminController@getRevenueChart');
Route::post('/subscribers' , 'adminController@getSubscribers');
Route::post('/live' , 'adminController@live');
Route::post('/introSave' , 'adminController@introSave');
Route::post('/logo' , 'adminController@logoSave');

//Videos
Route::group(['prefix' => '/courses'],function(){

  Route::get('/' , 'VideoController@index')->name('admin.playlists');
  Route::get('/{id}/videos' , 'VideoController@getPlaylist');
  Route::post('/{id}/upload' , 'VideoController@uploadVideo');
  Route::post('/{id}/edit' , 'VideoController@updateVideo');
  Route::post('/{id}/delete' , 'VideoController@deleteVideo');
  Route::post('/add-playlist' , 'VideoController@addPlaylist');
  Route::post('/{id}/poster' , 'VideoController@updatePoster');
  Route::get('/{id}/poster/{poster}' , 'VideoController@getPoster');
});

Route::group(['prefix' => '/exams'],function(){

  Route::get('/' , 'ExamsController@index')->name('admin.exams');
  Route::get('/{exam}' , 'ExamsController@edit')->name('admin.exams.edit');
  Route::post('/save' , 'ExamsController@save');
});

Route::group(['prefix' => '/schedule'],function(){

  Route::get('/' , 'ScheduleController@index')->name('admin.schedule');
  Route::post('/save' , 'ScheduleController@save');
});



Route::group(['prefix' => '/teachers'],function(){

  Route::get('/' , 'TeachersController@index')->name('admin.teachers');
  Route::post('/add' , 'TeachersController@add');
  Route::post('/add/cv' , 'TeachersController@addCV');
  Route::post('/delete/cv' , 'TeachersController@deleteCV');
  Route::get('/download/{teacher}/cv' , 'TeachersController@downloadCV');
});

Route::group(['prefix' => '/students'],function(){

  Route::get('/' , 'StudentsController@index')->name('admin.students');
  Route::post('/points/update' , 'StudentsController@updatePoints');
});
