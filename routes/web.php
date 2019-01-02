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
Auth::routes();

Route::get('users/{user}', "UserController@show");

Route::get('recipes/{recipe}', 'RecipeController@show');
Route::get('recipes', "RecipeController@index");
Route::get('create_recipe', "RecipeController@createRecipe");
Route::post('recipe/store', "RecipeController@store");

Route::get('ingredients/{ingredient}/destroy', "IngredientController@destroy");
Route::post('ingredients/store', "IngredientController@store");

Route::post('foods', "FoodController@store");
Route::get('foods/{food}', "FoodController@show");

Route::get('/', 'HomeController@index')->name('home');
