<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//This is for the get event of the index page
Route::get('/', array('as' => 'index_page', 'uses' => 'ImageController@getIndex'));

//This is for the post event of the index page
Route::post('/', array('as' => 'index_page_post', 'before' => 'csrf', 'uses' => 'ImageController@postIndex'));

//This is to show the image's permalink on our website
Route::get('snatch/{id}', array('as' => 'get_image_information', 'uses' => 'ImageController@getSnatch'))->where('id', '[0-9]+');

//This route is to show all images.
Route::get('all',array('as'=>'all_images','uses'=>'ImageController@getAll'));

//This route is to delete the image with given ID
Route::get('delete/{id}', array('as' => 'delete_image', 'uses' => 'ImageController@getDelete'))->where('id', '[0-9]+');