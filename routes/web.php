<?php


Route::auth();

Route::get('lang/{locale}', function ($locale) {

session(['locale' => $locale]);

return redirect('/');
});

Route::get('/logout', function () {

\Auth::logout();

return redirect('/');
});

Route::get('v/{id}/getThumb' , 'VideoController@getThumb');
Route::get('/p/{id}' , 'SettingsController@getPic');


Route::group(['prefix' => '/' , 'middleware' => 'guest' ],function(){

  Route::get('/', 'HomeController@home');
  Route::post('contact', 'HomeController@contact')->name('home.contact');
  Route::post('newsletter', 'HomeController@newsletter')->name('home.newsletter');

});


//Admin Routes
Route::group(['prefix' => '/admin' , 'middleware' => ['auth' , 'Admin'] ],function(){

  require('routes/admin.php');

});

//Home Routes
Route::group(['middleware' => ['auth' , 'notAdmin'] ],function(){

  require('routes/home.php');
});



//FOR ALL
Route::group(['middleware' => ['auth'] ],function(){

  require('routes/all.php');
});
