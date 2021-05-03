<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksUsersController extends Controller
{
    public function index()
    {
       // $users = User::all();
        return view('multi_task_user');//->with('users', $users);
    }
}
