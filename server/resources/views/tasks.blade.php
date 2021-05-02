{{--@extends('layouts.app')--}}

{{--@section('content')--}}

{{--    <!-- Bootstrap Boilerplate... -->--}}

{{--    <div class="panel-body">--}}
{{--        <!-- Display Validation Errors -->--}}
{{--    @include('common.errors')--}}

{{--    <!-- New Task Form -->--}}
{{--        <form action="{{ url('task') }}" method="POST" class="form-horizontal">--}}
{{--        {!! csrf_field() !!}--}}

{{--        <!-- Task Name -->--}}
{{--            <div class="form-group">--}}
{{--                <label for="task" class="col-sm-3 control-label">Task</label>--}}

{{--                <div class="col-sm-6">--}}
{{--                    <input type="text" name="name" id="task-name" class="form-control">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Add Task Button -->--}}
{{--            <div class="form-group">--}}
{{--                <div class="col-sm-offset-3 col-sm-6">--}}
{{--                    <button type="submit" class="btn btn-default">--}}
{{--                        <i class="fa fa-plus"></i> Add Task--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

{{--    <!-- TODO: Current Tasks -->--}}
{{--@endsection--}}











@extends('tasks.layout')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>

            <th>Tasks</th>
            <th>Users</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($tasks as $task)
            <tr>

                <td>{{ $task->title }}</td>
                <td>{{ $task->done }}</td>
                <td>
                    <ul>
                        @foreach ($task->users as $user)

                            <li>{{ $user->name }}</li>>

                        @endforeach
                    </ul>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $tasks->links() !!}

@endsection
