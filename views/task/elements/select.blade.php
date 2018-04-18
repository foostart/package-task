<!-- CATEGORY LIST -->
<div class="form-group">
    <?php $task_name = $request->get('task_titlename') ? $request->get('task_name') : @$task->task_name ?>

    {!! Form::label('category_id', trans('task::task_admin.task_categoty_name').':') !!}
    {!! Form::select('category_id', @$categories, @$task->category_id, ['class' => 'form-control']) !!}
</div>
<!-- /CATEGORY LIST -->