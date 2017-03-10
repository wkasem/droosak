<?php


Route::group(['middleware' =>'auth:api'] , function(){

  Route::get('courses/{id}' , 'ApiController@getCourse');
  Route::get('courses' , 'ApiController@getCourseList');
});
