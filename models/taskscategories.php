<?php

namespace Foostart\Task\Models;

use Illuminate\Database\Eloquent\Model;

class TasksCategories extends Model {

    protected $table = 'tasks_categories';
    public $timestamps = false;
    protected $fillable = [
        'task_category_name'
    ];
    protected $primaryKey = 'task_category_id';

    public function get_tasks_categories($params = array()) {
        $eloquent = self::orderBy('task_category_id');

        if (!empty($params['task_category_name'])) {
            $eloquent->where('task_category_name', 'like', '%'. $params['task_category_name'].'%');
        }
        $tasks_category = $eloquent->paginate(10);
        return $tasks_category;
    }

    /**
     *
     * @param type $input
     * @param type $task_id
     * @return type
     */
    public function update_task_category($input, $task_id = NULL) {

        if (empty($task_id)) {
            $task_id = $input['task_category_id'];
        }

        $task = self::find($task_id);

        if (!empty($task)) {

            $task->task_category_name = $input['task_category_name'];

            $task->save();

            return $task;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_task_category($input) {

        $task = self::create([
                    'task_category_name' => $input['task_category_name'],
        ]);
        return $task;
    }

    /**
     * Get list of tasks categories
     * @param type $category_id
     * @return type
     */
     public function pluckSelect($category_id = NULL) {
        if ($category_id) {
            $categories = self::where('task_category_id', '!=', $category_id)
                    ->orderBy('task_category_name', 'ASC')
                ->pluck('task_category_name', 'task_category_id');
        } else {
            $categories = self::orderBy('task_category_name', 'ASC')
                ->pluck('task_category_name', 'task_category_id');
        }
        return $categories;
    }

}
