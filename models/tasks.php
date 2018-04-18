<?php

namespace Foostart\Task\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model {

    protected $table = 'tasks';
    public $timestamps = false;
    protected $fillable = [
        'task_name',
        'category_id'
    ];
    protected $primaryKey = 'task_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_tasks($params = array()) {
        $eloquent = self::orderBy('task_id');

        //task_name
        if (!empty($params['task_name'])) {
            $eloquent->where('task_name', 'like', '%'. $params['task_name'].'%');
        }

        $tasks = $eloquent->paginate(10);//TODO: change number of item per page to configs

        return $tasks;
    }



    /**
     *
     * @param type $input
     * @param type $task_id
     * @return type
     */
    public function update_task($input, $task_id = NULL) {

        if (empty($task_id)) {
            $task_id = $input['task_id'];
        }

        $task = self::find($task_id);

        if (!empty($task)) {

            $task->task_name = $input['task_name'];
            $task->category_id = $input['category_id'];

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
    public function add_task($input) {

        $task = self::create([
                    'task_name' => $input['task_name'],
                    'category_id' => $input['category_id'],
        ]);
        return $task;
    }
}
