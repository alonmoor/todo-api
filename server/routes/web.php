<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TasksUsersController;
use App\Http\Controllers\HomeController;
use Inertia\Inertia;
use App\Task;
use App\Models\User;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/');
});//->name('dashboard');

Auth::routes();



//Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});


//Route::post('/', function () {
//    return view('welcome');
//});

//------------------------------------------------------------------------------------------------------
Route::resource('/users', UsersController::class,);
Route::get('/home', [\App\Http\Controllers\UsersController::class, 'index'])->name('home');




Route::get('/dashboard', 'HomeController@dashboard')
    ->name('dashboard');
    //->middleware('auth');


//Route::resource('users', UsersController::class,);
//Route::post('/users', '\App\Http\Controllers\UsersController@index');
//Route::get('/users/about', [UsersController::class]);
//Route::post('/users', [UsersController::class, "index"]);

//Route::resource('/', UsersController::class,);

//Route::post('/users/{id}', [UsersController::class, 'update']);


//Route::get('/users/{id}', [UsersController::class, 'update']);
//Route::get('/users/{id}', [TestController::class, 'show']);



//Route::resource('usres/{id}', UsersController::class);

//Route::get('/mult-users', function () {
//    $tasks = \App\Task::with('users')->get();
//    return view('tasks.index'.comparesEqualTo('tasks'));
//});




//Route::get('/tasks', function () {
//    $task = \App\Task::first();
//   // dd($tasks->users->first());
//   // dd($tasks->users->first()->pivot->vcreated_at);
////    dd($tasks->users);
//    $tasks =  \App\Task::width('user','task')->get();
//     return view('tasks.index'.compact('tasks'));
//});



//Route::get('/mult-users', function () {
//    $tasks = \App\Task::with('users')->get();
//    return view('tasks.index'.comparesEqualTo('tasks'));
//});


//Route::get('/mult-users', [TasksUsersController::class, 'index'])->name('multi-insert');




//---------------------------------------------------------------------------------------------
//
//Route::group(['middleware' => 'web'], function () {
//
//    /**
//     * Show Task Dashboard
//     */
//    Route::get('/', function () {
//        return view('tasks');
//    });
//
//    /**
//     * Add New Task
//     */
//    Route::post('/task', function (Request $request) {
//        //
//    });
//
//    /**
//     * Delete Task
//     */
//    Route::delete('/task/{task}', function (Task $task) {
//        //
//    });
//});
//
//
//
//
//
///**
// * Add New Task
// */
//Route::post('/task', function (Request $request) {
//    $validator = Validator::make($request->all(), [
//        'name' => 'required|max:255',
//    ]);
//
//    if ($validator->fails()) {
//        return redirect('/')
//            ->withInput()
//            ->withErrors($validator);
//    }
//
//    // Create The Task...
//});
//
//
//
//
//
//
//
//Route::group(['middleware' => 'web'], function () {
//
//    /**
//     * Show Task Dashboard
//     */
//    Route::get('/', function () {
//        return view('tasks');
//    });
//
//    /**
//     * Add New Task
//     */
//    Route::post('/task', function (Request $request) {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|max:255',
//        ]);
//
//        if ($validator->fails()) {
//            return redirect('/')
//                ->withInput()
//                ->withErrors($validator);
//        }
//
//        $task = new Task;
//        $task->name = $request->name;
//        $task->save();
//
//        return redirect('/');
//    });
//
//    /**
//     * Delete Task
//     */
//    Route::delete('/task/{task}', function (Task $task) {
//        //
//    });
//});
//
//
//

//Route::group(['middleware' => 'web'], function () {
//
//    /**
//     * Show Task Dashboard
//     */
//    Route::get('/', function () {
//        $tasks = Task::orderBy('created_at', 'asc')->get();
//
//        return view('tasks', [
//            'tasks' => $tasks
//        ]);
//    });
//
//    /**
//     * Add New Task
//     */
//    Route::post('/task', function (Request $request) {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|max:255',
//        ]);
//
//        if ($validator->fails()) {
//            return redirect('/')
//                ->withInput()
//                ->withErrors($validator);
//        }
//
//        $task = new Task;
//        $task->name = $request->name;
//        $task->save();
//
//        return redirect('/');
//    });
//
//    /**
//     * Delete Task
//     */
//    Route::delete('/task/{task}', function (Task $task) {
//        $task->delete();
//
//        return redirect('/');
//    });
//});
