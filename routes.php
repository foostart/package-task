<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('task', [
    'as' => 'task',
    'uses' => 'Foostart\Task\Controllers\Front\TaskFrontController@index'
]);


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see'],
                  'namespace' => 'Foostart\Task\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage task
          |-----------------------------------------------------------------------
          | 1. List of tasks
          | 2. Edit task
          | 3. Delete task
          | 4. Add new task
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/tasks', [
            'as' => 'tasks.list',
            'uses' => 'TaskAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/tasks/edit', [
            'as' => 'tasks.edit',
            'uses' => 'TaskAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/tasks/copy', [
            'as' => 'tasks.copy',
            'uses' => 'TaskAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/tasks/edit', [
            'as' => 'tasks.post',
            'uses' => 'TaskAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/tasks/delete', [
            'as' => 'tasks.delete',
            'uses' => 'TaskAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/tasks/trash', [
            'as' => 'tasks.trash',
            'uses' => 'TaskAdminController@trash'
        ]);

        /**
         * configs
        */
        Route::get('admin/tasks/config', [
            'as' => 'tasks.config',
            'uses' => 'TaskAdminController@config'
        ]);

        Route::post('admin/tasks/config', [
            'as' => 'tasks.config',
            'uses' => 'TaskAdminController@config'
        ]);

        /**
         * language
        */
        Route::get('admin/tasks/lang', [
            'as' => 'tasks.lang',
            'uses' => 'TaskAdminController@lang'
        ]);

        Route::post('admin/tasks/lang', [
            'as' => 'tasks.lang',
            'uses' => 'TaskAdminController@lang'
        ]);

    });
});
