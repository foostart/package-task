<!-- SAMPLE NAME -->
<div class="form-group">
    <?php $task_category_name = $request->get('task_titlename') ? $request->get('task_name') : @$task->task_category_name ?>
    {!! Form::label($name, trans('task::task_admin.name').':') !!}
    {!! Form::text($name, $task_category_name, ['class' => 'form-control', 'placeholder' => trans('task::task_admin.name').'']) !!}
</div>
<!-- /SAMPLE NAME -->