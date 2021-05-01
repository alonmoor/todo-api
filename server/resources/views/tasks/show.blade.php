 @extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-center">
            <h2 class="font-weight-bold"> {{ $task->title }}</h2>
        </div>
    </div>

    <div class="row mx-auto">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $task->title }}
            </div>
        </div>
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Introduction:</strong>--}}
{{--                {{ $user->introduction }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Location:</strong>--}}
{{--                {{ $user->location }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Cost:</strong>--}}
{{--                {{ $user->cost }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Date Created:</strong>--}}
{{--                {{ date_format($user->created_at, 'jS M Y') }}--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
     @endsection
