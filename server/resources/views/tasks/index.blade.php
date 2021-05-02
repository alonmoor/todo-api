@extends('layouts.app')

@section('content')
<div class="container  w-5/6 py-10">
    <div class="row justify-content-center m-auto">
        <div class="col-m-8">
            <div class="p-5 card">


                    <h1 class="text-gray-700 text-5xl">{{ $task->title }}</h1>
                    <p>{{ $task->user-name }}</p>
                <ul>
                    @foreach($tasks->user as $user)

                        <li>{{ $user->name }} {{ $user->pivot->user_id  }} </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
