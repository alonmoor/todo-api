<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Http\Respone;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Models\User;
use App\Models\TaskUser;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//// Route::resource('products', ProductController::class);
//
//// Public routes
//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/login', [AuthController::class, 'login']);
//Route::get('/products', [ProductController::class, 'index']);
//Route::get('/products/{id}', [ProductController::class, 'show']);
//Route::get('/products/search/{name}', [ProductController::class, 'search']);
//
//
//// Protected routes
//Route::group(['middleware' => ['auth:sanctum']], function () {
//    Route::post('/products', [ProductController::class, 'store']);
//    Route::put('/products/{id}', [ProductController::class, 'update']);
//    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
//    Route::post('/logout', [AuthController::class, 'logout']);
//});
//
//
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::get('/companies', [\App\Http\Controllers\CompanyController::class, 'index']);
//Route::get('/companies/{company}', [\App\Http\Controllers\CompanyController::class, 'show']);
//Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);








//Route::get('/tasks', [\App\Http\Controllers\CompanyController::class, 'index']);
//Route::get('/companies/{company}', [\App\Http\Controllers\CompanyController::class, 'show']);
//Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);




//Route::get('task_user', function() {
////Route::get('task_user/{id}', function() {
//    // If the Content-Type and Accept headers are set to 'application/json',
//    // this will return a JSON structure. This will be cleaned up later.
//    return \App\Models\TaskUser::all();
////    $id = Auth::user()->id;
////    return TaskUser::find($id);
//});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



//============================================================================


Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});



// Route::resource('products', ProductController::class);

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Route::get('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
   Route::post('/products', [ProductController::class, 'store']);
   Route::put('/products/{id}', [ProductController::class, 'update']);
   Route::delete('/products/{id}', [ProductController::class, 'destroy']);
   Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('users', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return User::all();
});

Route::post('users', function(Request $request) {
    $user = User::create($request->all());
    return $user;
});

//====================================================================================

Route::get('/product', function() {


 //print_r(Auth::user());die();
   $id = 1;//Auth::user()->id;
// $userId = Auth;
// dd($userId);
  // $user = User::find(1);
  //   return $user->tasks;

        if (!Auth::user()) {
      // $user = User::find(1);
      //   return $user->tasks;
return "boolshit";

    }else{
        return Task::all();
    }

});



Route::get('tasks', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    $user = User::find(1);
      return $user->tasks;

    return Task::all();



});



Route::get('tasks/{id}', function($id) {
    return Task::find($id);
});

Route::post('tasks', function(Request $request) {
    $task = Task::create($request->all());
    return $task;
});

Route::put('tasks/{id}', function(Request $request, $id) {
    $task = Task::findOrFail($id);
    $task->update($request->all());
    return $task;
});

Route::patch('tasks/{id}', function(Request $request, $id) {
    $task = Task::findOrFail($id);
    $task->update($request->all());
    return $task;
});

Route::delete('tasks/{id}', function($id) {
    Task::find($id)->delete();
    return 204;
});
