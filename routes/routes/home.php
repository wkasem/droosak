<?php

Route::get('/home' , 'HomeController@index')->name('home.index');
Route::get('/validation' , 'HomeController@validation')->name('errors.validation');
Route::post('/validation/phone' , 'HomeController@validatePhone')->name('validation.phone');
Route::post('/validation/email' , 'HomeController@validateEmail')->name('validation.email');
Route::post('/stream' , 'StreamController@on')->name('home.stream');
Route::get('/playlists' , 'HomeController@playlists')->name('home.playlists');
Route::get('playlists/{id}/videos' , 'HomeController@getPlaylist');

Route::post('live' , 'StreamController@on')->name('home.live');




Route::group(['prefix' => '/exams'],function(){

  Route::get('/' , 'HomeController@exams')->name('home.exams');
  Route::get('/{id}' , 'ExamsController@takeExam')->name('home.exams.take');
  Route::get('/{id}/start' , 'ExamsController@startExam')->name('home.exams.start');
  Route::post('/acceptAnswers' , 'ExamsController@acceptAnswers');
  Route::post('/finish' , 'ExamsController@finish');
});

Route::group(['prefix' => '/payment'],function(){

  Route::get('/' , 'PaymentController@index')->name('home.payment');
  Route::post('/' , 'PaymentController@checkout')->name('home.payment');
  Route::get('/success' , 'PaymentController@success')->name('home.payment.success');
  Route::get('/fail' , 'PaymentController@fail')->name('home.payment.fail');
});
