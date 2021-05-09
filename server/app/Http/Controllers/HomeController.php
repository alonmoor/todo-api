<?php

// namespace App\Http\Controllers;
//
// use Illuminate\Http\Request;
// use App\Task;
// class HomeController extends Controller
// {
//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }
//
//     /**
//      * Show the application dashboard.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         $tasks = Task::with('users')->get();
//         return view('home',compact('tasks'));
//      //   return view('home');
//     }
//
//      public function dashboard(){
//         return view('dashboard');
//      }
//
//
// }



namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
