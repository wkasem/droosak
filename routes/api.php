<?php


// Route::group(['middleware' => []] , function(){
//
// });

Route::get('courses/{id}' , 'ApiController@getCourse');
Route::get('courses' , 'ApiController@getCourseList');
