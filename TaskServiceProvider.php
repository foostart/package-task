<?php

namespace Foostart\Task;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

use URL, Route;
use Illuminate\Http\Request;


class TaskServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {
        /**
         * Publish
         */
         $this->publishes([
            __DIR__.'/config/task_admin.php' => config_path('task_admin.php'),
        ],'config');

        $this->loadViewsFrom(__DIR__ . '/views', 'task');


        /**
         * Translations
         */
         $this->loadTranslationsFrom(__DIR__.'/lang', 'task');


        /**
         * Load view composer
         */
        $this->taskViewComposer($request);

         $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations')
            ], 'migrations');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';

        /**
         * Load controllers
         */
        $this->app->make('Foostart\Task\Controllers\Admin\TaskAdminController');

         /**
         * Load Views
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'task');
    }

    /**
     *
     */
    public function taskViewComposer(Request $request) {

        view()->composer('task::task*', function ($view) {
            global $request;
            $task_id = $request->get('id');
            $is_action = empty($task_id)?'page_add':'page_edit';

            $view->with('sidebar_items', [

                /**
                 * Tasks
                 */
                //list
                trans('task::task_admin.page_list') => [
                    'url' => URL::route('admin_task'),
                    "icon" => '<i class="fa fa-list-ul"></i>'
                ],
                //add
                trans('task::task_admin.'.$is_action) => [
                    'url' => URL::route('admin_task.edit'),
                    "icon" => '<i class="fa fa-pencil-square-o"></i>'
                ],

                /**
                 * Categories
                 */
                //list
                trans('task::task_admin.page_category_list') => [
                    'url' => URL::route('admin_task_category'),
                    "icon" => '<i class="fa fa-sitemap"></i>'
                ],
            ]);
            //
        });
    }

}
