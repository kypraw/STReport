<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['guest']], function(){
    Route::get('/', [
        'uses' => 'AuthController@getHome',
        'as' => 'home'
    ]);

    Route::get('/login', [
        'uses' => 'AuthController@getLogin',
        'as' => 'login'
    ]);

    Route::post('login', [
        'uses' => 'AuthController@postLogin',
        'as' => 'login.post'
    ]);
});

Route::get('logout', [
    'middleware' => 'auth',
    'uses' => 'AuthController@getLogout',
    'as' => 'logout'
]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('report', [
        'uses' => 'ReportController@getReport',
        'as' => 'report'
    ]);
    Route::get('report/add', [
        'uses' => 'ReportController@getReportAdd',
        'as' => 'report.add'
    ]);

    Route::post('report', [
        'uses' => 'ReportController@postReport',
        'as' => 'report.post'
    ]);

    Route::get('report/view/{report_unique_code}', [
        'uses' => 'ReportController@getReportView',
        'as' => 'report.view'
    ]);

    Route::get('report/edit/{report_unique_code}',[
        'uses' => 'ReportController@getReportEdit',
        'as' => 'report.edit'
    ]);

    Route::post('report/edit/{report_unique_code}',[
        'uses' => 'ReportController@postReportEdit',
        'as' => 'report.editpost'
    ]);

    Route::post('report/delete/{report_unique_code}',[
        'uses' => 'ReportController@postReportDelete',
        'as' => 'report.delete'
    ]);
});

Route::group(['middleware' => ['auth', 'isAdmin']], function(){
    Route::get('dashboard',[
        'uses' => 'DashboardController@getDashboard',
        'as' => 'dashboard'
    ]);

    Route::get('dashboard/view/{report_id}', [
        'uses' => 'DashboardController@getReport',
        'as' => 'dashboard.view'
    ]);

    Route::get('dashboard/search', [
        'uses' => 'DashboardController@getDashboardSearch',
        'as' => 'dashboard.search'
    ]);
});
