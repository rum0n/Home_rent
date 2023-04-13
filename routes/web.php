<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'FrontEndController@index')->name('home_page');
Route::get('/post/{id}', 'FrontEndController@single_post')->name('single_post');

//Route::get('/reply/{id}', 'FrontEndController@replies')->name('replies');

//=======================Search route=====================
Route::get('/search', 'FrontEndController@search')->name('search');
Route::get('/filter', 'FrontEndController@filter')->name('filter');


Route::post('/subscribe', 'SubscriberController@subscribe')->name('subscribe');

//Auth::routes();
Auth::routes(['verify' => true]);

/*
|===================================================
| 		Login with Social Routes
|===================================================
*/

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social_login');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

/*
|===================================================
| 			Social Routes ends
|===================================================
*/

//Route::get('/home', 'HomeController@index')->name('home');


/*========================
	   Admin Route
=========================*/

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']],function(){

    Route::get('/dashboard','AdminController@index')->name('dashboard');
    Route::get('/admin_profile','AdminController@admin_profile')->name('admin_profile');
    Route::post('/profile_edit','AdminController@profile_edit')->name('Profile_edit');

     // ============Category Route==============

	Route::get('/category','CategoryController@category_form')->name('category');
	Route::post('/category/insert','CategoryController@category_insert')->name('cat_category');

	Route::get('/category/delete/{id}','CategoryController@category_delete')->name('category_delete');

	Route::get('/category/edit/{id}','CategoryController@category_edit')->name('category_edit');

	Route::post('/category/update','CategoryController@category_update')->name('category_update');


	// ============User Control Route==============
	Route::resource('/users','UserController');
	Route::get('/block/{user}','UserController@blockUnblock')->name('block_unblock');
	Route::get('/user/{id}/promote','UserController@promoteDemote')->name('promote_demote');

	// ============Post Route==============
	Route::resource('/post','PostController');
	Route::post('/{accept}','PostController@accept_post')->name('accept_post');

	Route::post('reject/{post}','PostController@reject_post')->name('reject_post');

	Route::get('/rejected','PostController@rejected_post')->name('rejected_post');

	// ============Subscriber Route==============
	Route::resource('/subscriber','SubscriberController');

	// ============Search Route for dashboard==============
	Route::get('/deleted','PostController@deleted')->name('deleted');

	Route::get('/restore/{id}','PostController@restore')->name('restore');

	Route::post('/permanent/delete/{id}','PostController@permanent_delete')->name('permanent_delete');

//	Route::get('/search','AdminController@search')->name('search');

});




/*========================
	   User Route
=========================*/ 
Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'User', 'middleware' => ['auth', 'user', 'verified']],function(){

	// ============Profile Route==============

    Route::get('/dashboard','UserController@index')->name('dashboard');
	// Route::get('/overview','UserController@overview')->name('overview');
    Route::get('/user_profile','UserController@user_profile')->name('user_profile');
    Route::post('/profile_edit','UserController@profile_edit')->name('Profile_edit');

	// ============Post Route==============
	Route::resource('/post','PostController');
	Route::get('/delete/{id}/{pic_name}','PostController@deletePic');

	// ============Post Comments Route==============
	Route::resource('/comment','CommentController');


});







