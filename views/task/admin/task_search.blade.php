
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('task::task_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_task','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            {!! Form::label('task_name', trans('task::task_admin.task_name_label')) !!}
            {!! Form::text('task_name', @$params['task_name'], ['class' => 'form-control', 'placeholder' => trans('task::task_admin.task_name_placeholder')]) !!}
        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('task::task_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


