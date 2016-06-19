<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

/**
 * Dashboard management
 * dashboard/users/route_action
 */
Route::group(['prefix' => '/dashboard', 'middleware' => ['web', 'auth']], function () {

    Route::get('/', [
        'as' => 'dashboard.index',
        'uses' => 'DashboardController@index',
    ]);

    Route::get('/settings', [
        'as' => 'dashboard.settings',
        'uses' => 'DashboardController@settings',
    ]);

    Route::group(['prefix' => '/books'], function () {

        Route::get('/', [
            'as' => 'dashboard.books.index',
            'uses' => 'BooksController@index'
        ]);

        Route::get('/add', [
            'as' => 'dashboard.books.add',
            'uses' => 'BooksController@add'
        ]);

        Route::get('/edit/{document_id}',[
            'as' => 'dashboard.books.edit',
            'uses' => 'BooksController@edit'
        ]);

    });

});

Route::get('/home', 'HomeController@index');
