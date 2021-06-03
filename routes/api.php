<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// get profile data
Route::get('/get-profile-data','MyProfileController@index');
// 
// Get skills
Route::get("/get-all-skills","SkillsController@index");
// 
// Get Project Category
Route::get('/get-project-category','ProjectCategoryController@index');
// 

// Get projects
Route::get("/get-projects","ProjectsController@index");
Route::get("/get-project-details","ProjectsController@show");
Route::get("/prev-next-project","ProjectsController@prevNextProject");
// 

// Get Albums
Route::get("/get-albums","AlbumController@index");

Route::get('/album-with-image',"AlbumController@getImageAndData");
Route::get("/image-6","AlbumController@getImg6");

// Blog Categories
Route::get("/get-blog-category","BlogCategoryControllerController@index");
Route::get("/get-blog-ctg-data","BlogCategoryControllerController@ctgData");
Route::get("/get-blog-details","BlogController@show");
// 

// Blogs
Route::get("/get-blog-posts-by-category","BlogController@index");
Route::get("/get-blog-data","BlogController@show");
Route::get("/get-latest-blogs", "BlogController@getLatesBlog");
// 

