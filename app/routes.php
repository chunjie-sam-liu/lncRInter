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



Route::get('/','HomeController@show');
Route::get('/Search','SearchController@show');
Route::get('/Submit','BrowseController@Submitshow');
Route::get('/Database','BrowseController@databaseshow');
Route::get('/Document','BrowseController@methodshow');
Route::get('/Documentdata','BrowseController@methoddatashow');
Route::get('/Contact','BrowseController@contactshow');
Route::get('/Download','BrowseController@downloadshow');
Route::get('/submit_result','ShowController@showsubmit_result');
Route::get('/submit_result_show','ShowController@showsubmit_result');
Route::get('/browse','BrowseController@browseshow');

Route::get('/Search_result','SearchController@resultshow');
Route::get('/quicklyresult','SearchController@quicklyresultshow');


Route::get('/Detail','ShowController@showdetail');
Route::get('/Detail_rna','ShowController@showdetail_rna');
Route::get('/Detail_prot','ShowController@showdetail_prot');
Route::get('/Waiting','ShowController@download');


Route::get('/CreateTxtFile','BrowseController@CreateTxtFileshow');
Route::get('/CreateTxtFile2','BrowseController@CreateTxtFile2show');
Route::get('/CreateTxtFile3','BrowseController@CreateTxtFile3show');
//Route::get('/photo','HomeController@photoshow');




