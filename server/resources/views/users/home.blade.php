@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Dashboard
            </header>

            <div class="w-full p-6">
                <p class="text-gray-700">
                    You are logged in!
                </p>
            </div>
        </section>
    </div>
</main>


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
{{--            <td>{{ $task->done }}</td>--}}
            <td>
                <ul>
                    @foreach ($task->users as $user)

                        <li>{{ $user->name }}</li>

                    @endforeach
                </ul>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>






<thead>
<tr>
    <th>Users</th>
    <th>Tasks</th>
</tr>
</thead>

<tbody>
@foreach ($task->users as $user)

    <tr>

        <td>{{ $user->name }}</td>

        <td>
            <ul>
                @foreach ($tasks as $task)


                    <li>{{ task->title }}</li>

                @endforeach
            </ul>

        </td>
    </tr>
@endforeach
</tbody>
</table>


@endsection
