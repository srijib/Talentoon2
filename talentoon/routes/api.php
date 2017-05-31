<?php

use Illuminate\Http\Request;
//use Dingo\Api\Routing\Router;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//check the ability in the conroller's constructor
Route::resource('comment','CommentController');
//Haven't considered yet
Route::post('/uploads/singleuploded','UploadController@single_upload');

Route::post('/betalent',[
    'uses'=>'CategoryTalentController@store',
    'middleware'=> 'ability:audience,permission:be-talent']);

Route::group(['middleware' => ['ability:talent|mentor,create-post','checkrelatedcategory']], function () {
    Route::resource('categories.posts','PostsController');
});


// Route::group(['middleware'=>['ability:mentor,create-event,true','checkmentorauthority']],function(){
  Route::resource('categories.events','EventController');
// });

Route::get('/mostLikeabe','PostsController@mostLikablePosts');

Route::group(['middleware'=>['ability:mentor,create-workshop,true','checkmentorauthority']],function(){
    Route::resource('categories.workshops', 'WorkShopsController');
});

Route::get('/allworkshops', 'WorkShopsController@index');


//Route::get('/categorytalent/{talent_id}',[
//    'before' => 'jwt-auth',
//    'use'=>'CategoryTalentController@update'
//]);


Route::put('/categorytalent/{talent_id}','CategoryTalentController@update');

Route::resource('category','CategoriesController');
Route::get('/event/showall','EventController@index');


Route::resource('initial_reviews','InitialReviewController');



//this is called for when the talent choose to be talent and he needs to upload three of his work
Route::post('/store_media','InitialReviewController@store_media');

//this is to store initial review of one mentor on one talent on all the three files uploaded
Route::post('/store','InitialReviewController@store');


//to get all media related to mentor and talent
Route::get('/get_media_for_initial_review/{category_talent_id}/{category_mentor_id}','InitialReviewController@get_media_for_initial_review');


Route::post('/single_upload/{id}', 'UploadController@single_upload');
Route::post('/event_upload/{id}', 'UploadController@event_upload');

Route::post('/test2', 'UploadController@test2');
Route::put('/categorymentor/update','CategoryMentorController@update');
Route::post('/categorymentor/store','CategoryMentorController@store');

//Route::post('/signup','JWTAuth\SignUpController@signup');
Route::post('/signup','JWTAuth\SignUpController@register');
Route::post('/login','JWTAuth\LoginController@login');
Route::get('/authenticate','JWTAuth\LoginController@getAuthenticatedUser');

Route::post('/categorysubscribe','CategorySubscribeController@store');
Route::post('/categoryunsubscribe','CategorySubscribeController@update');

Route::post('/like','LikeController@store');
Route::post('/dislike','LikeController@update');
// Route::post('/userprofile','UserProfile@index');
Route::get('/userprofile',[
    'uses'=>'UserProfile@index',
    'middleware'=> 'jwt.auth']);
    Route::get('/userprofile/userposts',[
        'uses'=>'UserProfile@userposts',
        'middleware'=> 'jwt.auth']);

Route::post('/categorytalent/store','CategoryTalentController@store');


//Route::post('/posts/',['uses'=> 'PostsController@store','as'=>'post.store']);

Route::get('/countries','CountriesController@getAllCountries');

//Route for all initial posts and review
Route::get('/initial_posts/{mentor_id}','InitialReviewController@show_not_reviewed_initial_posts');
Route::post('/single_review','InitialReviewController@store_single_review');


Route::get('/post/{post_id}','PostsController@showSinglePost');

Route::post('/review_files_upload/{category_talent_id}', 'UploadController@review_files_upload');

//Entrust--------------------------------------------------------------------------
// Route to create a new role
Route::post('role', 'JwtAuthenticateController@createRole');
// Route to create a new permission
Route::post('permission', 'JwtAuthenticateController@createPermission');
// Route to assign role to user
Route::post('assign-role', 'JwtAuthenticateController@assignRole');
// Route to attach permission to a role
Route::post('attach-permission', 'JwtAuthenticateController@attachPermission');

// API route group that we need to protect
Route::group(['prefix' => 'api', 'middleware' => ['ability:admin,view-users']], function()
{
    // Protected route
    Route::get('users', 'JwtAuthenticateController@index');
});

// Authentication route
Route::post('authenticate', 'JwtAuthenticateController@authenticate');

Route::post('/workshop_upload/{id}', 'UploadController@workshop_upload');
Route::post('/share','ShareController@store');
Route::get('/workshop/{workshop_id}','WorkShopsController@show');

Route::post('/workshop_enroll','WorkShopsController@enroll');


Route::get('/categorymentor/get_mentor_details/{mentor_id}', 'CategoryMentorController@get_mentor_details');
Route::post('/conference/add_teacher', 'VideoConferenceController@add_wiziq_teacher');
Route::post('/conference/create_class', 'VideoConferenceController@create_wiziq_class');
Route::post('/session_upload/{id}', 'UploadController@session_upload');
Route::post('/workshop/{workshop_id}','WorkShopsController@createSession');
