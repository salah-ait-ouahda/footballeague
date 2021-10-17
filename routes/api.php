<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Team
    Route::apiResource('teams', 'TeamApiController');

    // Players
    Route::post('players/media', 'PlayersApiController@storeMedia')->name('players.storeMedia');
    Route::apiResource('players', 'PlayersApiController');

    // Staff
    Route::post('staff/media', 'StaffApiController@storeMedia')->name('staff.storeMedia');
    Route::apiResource('staff', 'StaffApiController');

    // Bordereau
    Route::apiResource('bordereaus', 'BordereauApiController');
});
