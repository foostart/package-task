
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('task::task_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_task_category','method' => 'get']) !!}

        <!--TITLE-->
		<div class="form-group">
            {!! Form::label('task_category_name',trans('task::task_admin.task_category_name_label')) !!}
            {!! Form::text('task_category_name', @$params['task_category_name'], ['class' => 'form-control', 'placeholder' => trans('task::task_admin.task_category_name')]) !!}
        </div>

        {!! Form::submit(trans('task::task_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




