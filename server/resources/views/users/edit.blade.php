{{-- @extends('layouts.app')--}}

{{--@section('content') --}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 margin-tb">--}}
{{--            <div class="text-center font-weight-bolder">--}}
{{--                <h2 class="font-weight-bold">Edit Project</h2>--}}
{{--            </div>--}}
{{--            --}}{{-- <div class="pull-right">--}}
{{--                <a class="btn btn-primary" href="{{ route('users.index') }}" title="Go back"> <i--}}
{{--                        class="fas fa-backward "></i> </a>--}}
{{--            </div> --}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <form action="{{ route('users.update', $user->id) }}" method="POST">--}}
{{--        @csrf--}}
{{--        @method('PUT')--}}

{{--        <div class="row">--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Name:</strong>--}}
{{--                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Introduction:</strong>--}}
{{--                    <textarea class="form-control" style="height:50px" name="introduction"--}}
{{--                        placeholder="Introduction">{{ $user->introduction }}</textarea>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Location:</strong>--}}
{{--                    <input type="text" name="location" class="form-control" placeholder="{{ $user->location }}"--}}
{{--                        value="{{ $user->location }}">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Cost:</strong>--}}
{{--                    <input type="number" name="cost" class="form-control" placeholder="{{ $user->cost }}"--}}
{{--                        value="{{ $user->cost }}">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
{{--                <a class="btn btn-primary" href="" data-dismiss="modal"> Cancel</a>--}}


{{--                <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </form>--}}
{{-- @endsection --}}
    <!DOCTYPE html>
<html>
<head>
    <title>Sample view</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<form action="/users" method="post">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">


            <div class="com-md-4">

                <div class="form-group">
                    <input type="hidden" id="{{ $user['id'] }}" name="id" value="{{ $user['id'] }}">
                    <label>Name:</label>
                    <input type="text" name="name" placeholder="Enter the name" class="form-control"
                           value="{{ $user['name'] }}">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" placeholder="Enter the email" class="form-control"
                           value="{{ $user['email'] }}">
                </div>
                <div class="form-group">
                    <label>password:</label>
                    <input id="password" type="password"
                           class="form-input w-full @error('password') border-red-500 @enderror" name="password" value="{{ $user['mobile'] }}" required>
                </div>


                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="Update">

                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="modal" data-target="#myModal">Edit</button>
                      | <a href="{{ URL::to('delete', array($user->id)) }}" class="btn btn-danger dropdown-toggle waves-effect waves-light">Delete</a>
                </div>


            </div>



{{--            @foreach ($Community as $communities)--}}
{{--                <tr>--}}
{{--                    <td>{{$communities->community_name}}</td>--}}
{{--                    <td> <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="modal" data-target="#myModal">Edit</button>--}}
{{--                        | <a href="{{ URL::to('delete', array($communities->id)) }}" class="btn btn-danger dropdown-toggle waves-effect waves-light">Delete</a></td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}




        </div>
    </div>

</form>

</body>
</html>
