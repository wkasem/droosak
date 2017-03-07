<?php

Route::get('/home' , 'HomeController@index')->name('home.index');
Route::get('/validation' , 'HomeController@validation')->name('errors.validation');
Route::post('/validation/phone' , 'HomeController@validatePhone')->name('validation.phone');
Route::post('/validation/email' , 'HomeController@validateEmail')->name('validation.email');
Route::post('/stream' , 'StreamController@on')->name('home.stream');
Route::post('/stream/off' , 'StreamController@off');
Route::get('/courses' , 'HomeController@playlists')->name('home.playlists');
Route::get('courses/{id}/videos' , 'HomeController@getPlaylist');

Route::get('/schedule' , 'HomeController@schedule')->name('home.schedule');
Route::post('live' , 'StreamController@on')->name('home.live');

Route::post('teacher/views' , 'TeachersController@getViews');
Route::post('teacher/notis' , 'TeachersController@getNotis');
Route::post('teacher/add/cv' , 'TeachersController@addCV');
Route::post('teacher/update/bio' , 'TeachersController@updateBio');
Route::post('teacher/courses/{id}/upload' , 'StreamController@uploadVideo');




Route::group(['prefix' => '/exams'],function(){

  Route::get('/' , 'HomeController@exams')->name('home.exams');
  Route::get('/{id}' , 'ExamsController@takeExam')->name('home.exams.take');
  Route::get('/{id}/start' , 'ExamsController@startExam')->name('home.exams.start');
  Route::get('{id}/download' , 'ExamsController@download');
  Route::post('/acceptAnswers' , 'ExamsController@acceptAnswers');
  Route::post('/finish' , 'ExamsController@finish');
  Route::post('/title' , 'ExamsController@getTitle');
});

Route::group(['prefix' => '/payment'],function(){

  Route::get('/' , 'PaymentController@index')->name('home.payment');
  Route::post('/' , 'PaymentController@checkout')->name('home.payment');
  Route::get('/success' , 'PaymentController@success')->name('home.payment.success');
  Route::get('/fail' , 'PaymentController@fail')->name('home.payment.fail');
});
