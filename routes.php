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

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('/admin/task', [
            'as' => 'admin_task',
            'uses' => 'Foostart\Task\Controllers\Admin\TaskAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/task/edit', [
            'as' => 'admin_task.edit',
            'uses' => 'Foostart\Task\Controllers\Admin\TaskAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/task/edit', [
            'as' => 'admin_task.post',
            'uses' => 'Foostart\Task\Controllers\Admin\TaskAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/task/delete', [
            'as' => 'admin_task.delete',
            'uses' => 'Foostart\Task\Controllers\Admin\TaskAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////




        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
         Route::get('admin/task_category', [
            'as' => 'admin_task_category',
            'uses' => 'Foostart\Task\Controllers\Admin\TaskCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/task_category/edit', [
            'as' => 'admin_task_category.edit',
            'uses' => 'Foostart\Task\Controllers\Admin\TaskCategoryAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/task_category/edit', [
            'as' => 'admin_task_category.post',
            'uses' => 'Foostart\Task\Controllers\Admin\TaskCategoryAdminController@post'
        ]);
         /**
         * delete
         */
        Route::get('admin/task_category/delete', [
            'as' => 'admin_task_category.delete',
            'uses' => 'Foostart\Task\Controllers\Admin\TaskCategoryAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
    });
});
