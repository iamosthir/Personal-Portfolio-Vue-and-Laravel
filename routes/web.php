<?php

use Illuminate\Support\Facades\Route;

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

Route::any("{any}",function(){
    return view("main.index");
})->where("any",'^(?!admin|api|upload$).*$');


// Api Calls for admin
Route::group(["prefix" => "admin"],function(){

    Route::group(["prefix"=>"dashboard"],function(){
        Route::any("{any}",function(){
            return view("admin.index");
        })->where("any",".*");
    });


// Update profile
Route::post("/update-profile","MyProfileController@updateProfile");
// 

// Skills
Route::post('/create-skills','SkillsController@store');
Route::get("/get-skills",'SkillsController@index');
Route::post("/delete-skill","SkillsController@destroy");
Route::get('/get-skill-data',"SkillsController@show");
Route::post("/update-skill","SkillsController@update");
// 

// ProjectCategory
Route::post('/create-project-category','ProjectCategoryController@store');
Route::get('/get-project-category-data','ProjectCategoryController@show');
Route::post("/project-ctg-update","ProjectCategoryController@update");
Route::post("/project-ctg-delete","ProjectCategoryController@destroy");
// 

// Project
Route::post("/create-project","ProjectsController@create");
Route::get("/get-projects","ProjectsController@indexForAdmin");
Route::post("/delete-project","ProjectsController@destroy");
Route::post("/update-project","ProjectsController@update");
// 

// Gallery
Route::post("/create-album","AlbumController@create");
Route::get("/get-album-data","AlbumController@show");
Route::post('/update-album', "AlbumController@update");

Route::post("/upload-photos","AlbumController@uploadPhoto");

Route::get("/album-images","AlbumController@getAllImage");
Route::post("/delete-album-images","AlbumController@delAlbumImg");
Route::post("/clear-album","AlbumController@emptyAlbum");
Route::post("/delete-album","AlbumController@destroy");
//

// Blog Category
Route::post("/create-blog-category","BlogCategoryControllerController@store");
Route::get("/get-blog-category-data","BlogCategoryControllerController@show");
Route::post('/blog-ctg-update',"BlogCategoryControllerController@update");
Route::post("/blog-ctg-delete","BlogCategoryControllerController@destroy");
// 

// Blog
Route::post("/create-blog","BlogController@store");
Route::get("/get-blogs","BlogController@indexForAdmin");
Route::post("/delete-blog","BlogController@destroy");
Route::post("/update-blog","BlogController@update");
// End

// Settings
Route::post("/change-layout-color","DashboardSettingController@layoutColor");
Route::post("/change-sidebar-color", "DashboardSettingController@sidebarColor");
Route::post("/change-color-theme", "DashboardSettingController@colorTheme");
Route::post("/change-header", "DashboardSettingController@changeHeader");
// 

// Reset Database
Route::post("/reset-database","DashboardSettingController@resetDb");
// 

});

