<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

/**
 * Dashboard management
 * dashboard/users/route_action
 */
Route::group(['prefix' => '/dashboard', 'middleware' => [ 'auth' ] ], function () {

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

        Route::post('/create', [
            'as' => 'dashboard.books.create',
            'uses' => 'BooksController@create'
        ]);

        Route::post('/{book_id}/update', [
            'as' => 'dashboard.books.update',
            'uses' => 'BooksController@update'
        ]);

        Route::get('/edit/{book_id}',[
            'as' => 'dashboard.books.edit',
            'uses' => 'BooksController@edit'
        ]);

        Route::get('/view/{book_id}',[
            'as' => 'dashboard.books.view',
            'uses' => 'BooksController@view'
        ]);

        Route::get('/delete/{book_id}',[
            'as' => 'dashboard.books.delete',
            'uses' => 'BooksController@delete'
        ]);

        Route::post('/remove', [
            'as' => 'dashboard.books.request.remove',
            'uses' => 'BooksController@remove'
        ]);

    });

});

Route::group(['prefix' => '/user_files', 'middleware' => [ 'auth' ] ], function () {

    Route::get('/{user_id}/{file_name}',[
        'as' => 'user_files.show',
        'uses' => 'RestrictedFilesController@show'
    ]);

});

Route::get('/home', 'HomeController@index');
