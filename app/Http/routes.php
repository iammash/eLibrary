<?php

Route::get('/', function () {
    return view('auth/login');
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

    Route::group(['prefix' => '/libraries'], function () {

        Route::get('/', [
            'as' => 'dashboard.libraries.index',
            'uses' => 'LibraryController@index'
        ]);

        Route::get('/new', [
            'as' => 'dashboard.libraries.new',
            'uses' => 'LibraryController@makeNew'
        ]);

        Route::get('/{library_id}/edit',[
            'as' => 'dashboard.libraries.edit',
            'uses' => 'LibraryController@edit'
        ]);

        Route::get('/{library_id}/view',[
            'as' => 'dashboard.libraries.view',
            'uses' => 'LibraryController@view'
        ]);

        Route::get('/{library_id}/delete',[
            'as' => 'dashboard.libraries.delete',
            'uses' => 'LibraryController@delete'
        ]);

        Route::post('/create',[
            'as' => 'dashboard.libraries.create',
            'uses' => 'LibraryController@create'
        ]);

        Route::post('/{library_id}/update', [
            'as' => 'dashboard.libraries.update',
            'uses' => 'LibraryController@update'
        ]);

        Route::post('/{library_id}/remove', [
            'as' => 'dashboard.libraries.remove',
            'uses' => 'LibraryController@remove'
        ]);

        Route::group(['prefix' => '/{library_id}/books'], function () {

            Route::get('/', [
                'as' => 'dashboard.libraries.books.index',
                'uses' => 'BooksController@index'
            ]);

            Route::get('/add', [
                'as' => 'dashboard.libraries.books.add',
                'uses' => 'BooksController@add'
            ]);

            Route::post('/create', [
                'as' => 'dashboard.libraries.books.create',
                'uses' => 'BooksController@create'
            ]);

            Route::post('/{book_id}/update', [
                'as' => 'dashboard.libraries.books.update',
                'uses' => 'BooksController@update'
            ]);

            Route::get('/edit/{book_id}',[
                'as' => 'dashboard.libraries.books.edit',
                'uses' => 'BooksController@edit'
            ]);

            Route::get('/view/{book_id}',[
                'as' => 'dashboard.libraries.books.view',
                'uses' => 'BooksController@view'
            ]);

            Route::get('/delete/{book_id}',[
                'as' => 'dashboard.libraries.books.delete',
                'uses' => 'BooksController@delete'
            ]);

            Route::post('/remove', [
                'as' => 'dashboard.libraries.books.request.remove',
                'uses' => 'BooksController@remove'
            ]);


        });

    });

});

Route::group(['prefix' => '/user_files', 'middleware' => [ 'auth' ] ], function () {

    Route::get('/{user_id}/{file_name}',[
        'as' => 'user_files.show',
        'uses' => 'RestrictedFilesController@show'
    ]);

});

Route::get('/home', 'HomeController@index');
