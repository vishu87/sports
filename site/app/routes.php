<?php

/* Admin routes */
Route::get('/admin', function(){
    return View::make('login');
});

 Route::get('/logout', function(){
        Auth::logout();
        return Redirect::to('/admin');
    });

Route::post('/admin', 'UserController@postLogin');

Route::group(['prefix' => 'admin', 'before' => 'auth'], function () {
   
    Route::get('/dashboard', 'DashboardController@getIndex');
    Route::get('/tree', 'AdminController@getTree');

    Route::resource('sports', 'SportsController');
    
    Route::resource('category', 'CategoryController');

    //POLLS
    Route::resource('poll', 'PollController');
    Route::post('poll/option/{id}','PollController@storeOption');
    Route::put('poll/option/{id}','PollController@updateOption');
    Route::delete('poll/option/{id}','PollController@destroyOption');
    Route::get('poll/{id}/edit/{option_id}','PollController@edit');

    Route::get('get_option_sport/{sport_id}/{level}','DashboardController@getSportCategory');


    Route::group(['prefix' => 'point'], function () {
        Route::get('/','FootballPointController@index');
        Route::post('/','FootballPointController@postAdd');
        Route::get('/edit/{id}','FootballPointController@getedit');
        Route::put('/update/{id}', 'FootballPointController@putupdate');
    });

     Route::group(['prefix' => 'teams'], function () {
        Route::get('/','TeamController@index');
        Route::post('/store','TeamController@store');
        Route::post('/storemulti','TeamController@storemulti');
        Route::get('/{id}','TeamController@getteam');
        Route::delete('/delete', 'TeamController@destroy');
        Route::delete('/delete/player', 'TeamController@destroyPlayer');
        Route::put('/player/status', 'TeamController@statusPlayer');
    });

     Route::group(['prefix' => 'match'], function () {
        Route::get('/','MatchController@getMatchs');
        Route::get('/all','MatchController@index');
        Route::get('/edit/{id}','MatchController@getedit');
        Route::get('/result/{id}','MatchController@getresult');
        Route::get('/live/{id}','MatchController@getlive');
        Route::get('/lineup/{id}','MatchController@getLineup');

        Route::post('/store','MatchController@postAdd');
        Route::post('/storemulti','MatchController@storemulti');

        Route::post('/store/live/{id}','MatchController@postAddLive');
        Route::post('/store/lineup/{id}','MatchController@postAddLineup');

        Route::put('/update/{id}', 'MatchController@putUpdate');
        Route::put('/update/result/{id}', 'MatchController@putUpdateResult');

        Route::delete('/delete', 'MatchController@destroy');
        Route::delete('/score/delete', 'MatchController@destroyscore');

    });

     Route::group(['prefix' => 'post'], function () {
        Route::get('/','PostController@getPosts');
        Route::post('/store','PostController@postAdd');
        Route::get('/edit/{id}','PostController@getedit');
        Route::put('/update/{id}', 'PostController@putupdate');
        Route::get('/delete/{id}', 'PostController@getdelete');

    });

     Route::group(['prefix' => 'news'], function () {
        Route::get('/','NewsController@index');
        Route::post('/store','NewsController@store');
        Route::get('/edit/{id}','NewsController@edit');
        Route::put('/update/{id}', 'NewsController@update');
        Route::get('/destroy/{id}', 'NewsController@destroy');

    });

      Route::group(['prefix' => 'groups'], function () {
        Route::get('/','GroupsController@index');
        Route::post('/store','GroupsController@store');
        Route::get('/edit/{id}','GroupsController@edit');
        Route::put('/update/{id}', 'GroupsController@update');
        Route::get('/destroy/{id}', 'GroupsController@destroy');

    });
     

});

Route::group(['before' => 'auth'], function () {
});
