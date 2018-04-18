<?php namespace Foostart\Task\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Task\Controllers\Admin\Controller;
use URL;
use Route,
    Redirect;
use Foostart\Task\Models\TasksCategories;
/**
 * Validators
 */
use Foostart\Task\Validators\TaskCategoryAdminValidator;

class TaskCategoryAdminController extends Controller {

    public $data_view = array();

    private $obj_task_category = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_task_category = new TasksCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

         $params =  $request->all();

        $list_task_category = $this->obj_task_category->get_tasks_categories($params);

        $this->data_view = array_merge($this->data_view, array(
            'tasks_categories' => $list_task_category,
            'request' => $request,
            'params' => $params
        ));
        return view('task::task_category.admin.task_category_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $task = NULL;
        $task_id = (int) $request->get('id');


        if (!empty($task_id) && (is_int($task_id))) {
            $task = $this->obj_task_category->find($task_id);

        }

        $this->data_view = array_merge($this->data_view, array(
            'task' => $task,
            'request' => $request
        ));
        return view('task::task_category.admin.task_category_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new TaskCategoryAdminValidator();

        $input = $request->all();

        $task_id = (int) $request->get('id');

        $task = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($task_id) && is_int($task_id)) {

                $task = $this->obj_task_category->find($task_id);
            }

        } else {
            if (!empty($task_id) && is_int($task_id)) {

                $task = $this->obj_task_category->find($task_id);

                if (!empty($task)) {

                    $input['task_category_id'] = $task_id;
                    $task = $this->obj_task_category->update_task_category($input);

                    //Message
                    $this->addFlashMessage('message', trans('task::task_admin.message_update_successfully'));
                    return Redirect::route("admin_task_category.edit", ["id" => $task->task_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('task::task_admin.message_update_unsuccessfully'));
                }
            } else {

                $task = $this->obj_task_category->add_task_category($input);

                if (!empty($task)) {

                    //Message
                    $this->addFlashMessage('message', trans('task::task_admin.message_add_successfully'));
                    return Redirect::route("admin_task_category.edit", ["id" => $task->task_id]);
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

        return view('task::task_category.admin.task_category_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $task = NULL;
        $task_id = $request->get('id');

        if (!empty($task_id)) {
            $task = $this->obj_task_category->find($task_id);

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

        return Redirect::route("admin_task_category");
    }

}