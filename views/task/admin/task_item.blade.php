
@if( ! $tasks->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('task::task_admin.order') }}</td>
            <th style='width:10%'>Task ID</th>
            <th style='width:50%'>Task title</th>
            <th style='width:20%'>{{ trans('task::task_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $tasks->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($tasks as $task)
        <tr>
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <td>{!! $task->task_id !!}</td>
            <td>{!! $task->task_name !!}</td>
            <td>
                <a href="{!! URL::route('admin_task.edit', ['id' => $task->task_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_task.delete',['id' =>  $task->task_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
 <span class="text-warning">
	<h5>
		{{ trans('task::task_admin.message_find_failed') }}
	</h5>
 </span>
@endif
<div class="paginator">
    {!! $tasks->appends($request->except(['page']) )->render() !!}
</div>