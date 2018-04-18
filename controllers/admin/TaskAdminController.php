<?php

namespace Foostart\Task\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Task\Controllers\Admin\Controller;
use URL;
use Route,
    Redirect;
use Foostart\Task\Models\Tasks;
use Foostart\Task\Models\TasksCategories;
/**
 * Validators
 */
use Foostart\Task\Validators\TaskAdminValidator;

class TaskAdminController extends Controller {

    public $data_view = array();
    private $obj_task = NULL;
    private $obj_task_categories = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_task = new Tasks();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $list_task = $this->obj_task->get_tasks($params);

        $this->data_view = array_merge($this->data_view, array(
            'tasks' => $list_task,
            'request' => $request,
            'params' => $params
        ));
        return view('task::task.admin.task_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $task = NULL;
        $task_id = (int) $request->get('id');


        if (!empty($task_id) && (is_int($task_id))) {
            $task = $this->obj_task->find($task_id);
        }

        $this->obj_task_categories = new TasksCategories();

        $this->data_view = array_merge($this->data_view, array(
            'task' => $task,
            'request' => $request,
            'categories' => $this->obj_task_categories->pluckSelect()
        ));
        return view('task::task.admin.task_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new TaskAdminValidator();

        $input = $request->all();

        $task_id = (int) $request->get('id');
        $task = NULL;

        $data = array();

        if ($this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($task_id) && is_int($task_id)) {

                $task = $this->obj_task->find($task_id);
            }
        } else {
            if (!empty($task_id) && is_int($task_id)) {

                $task = $this->obj_task->find($task_id);

                if (!empty($task)) {

                    $input['task_id'] = $task_id;
                    $task = $this->obj_task->update_task($input);

                    //Message
                    $this->addFlashMessage('message', trans('task::task_admin.message_update_successfully'));
                    return Redirect::route("admin_task.edit", ["id" => $task->task_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('task::task_admin.message_update_unsuccessfully'));
                }
            } else {

                $task = $this->obj_task->add_task($input);

                if (!empty($task)) {

                    //Message
                    $this->addFlashMessage('message', trans('task::task_admin.message_add_successfully'));
                    return Redirect::route("admin_task.edit", ["id" => $task->task_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('task::task_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data_view = array_merge($this->data_view, array(
            'task' => $task,
            'request' => $request,
                ), $data);

        return view('task::task.admin.task_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $task = NULL;
        $task_id = $request->get('id');

        if (!empty($task_id)) {
            $task = $this->obj_task->find($task_id);

            if (!empty($task)) {
                //Message
                $this->addFlashMessage('message', trans('task::task_admin.message_delete_successfully'));

                $task->delete();
            }
        } else {

        }

        $this->data_view = array_merge($this->data_view, array(
            'task' => $task,
        ));

        return Redirect::route("admin_task");
    }

}
