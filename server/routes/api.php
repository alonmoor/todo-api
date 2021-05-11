
<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Http\Respone;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
// });



// Route::resource('products', ProductController::class);

// Public routes
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
// //Route::get('/login', [AuthController::class, 'login']);
// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/products/{id}', [ProductController::class, 'show']);
// Route::get('/products/search/{name}', [ProductController::class, 'search']);


// // Protected routes
// Route::group(['middleware' => ['auth:sanctum']], function () {
//    Route::post('/products', [ProductController::class, 'store']);
//    Route::put('/products/{id}', [ProductController::class, 'update']);
//    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
//    Route::post('/logout', [AuthController::class, 'logout']);
// });



// Route::post('users', function(Request $request) {
//     $user = User::create($request->all());
//     return $user;
// });



// Route::group('prefix'->'api',function(Request $request){
//     //handle requests by assigning controller methods here for example
//     Route::get('tasks', TaskController::class);
// });
//Auth::routes();

//Route::resource('/test', TaskController::class);
//Route::resource('/product', ProductController::class);
//====================================================================================

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
  Route::get('logout', [ApiController::class, 'logout']);
  Route::get('get_user', [ApiController::class, 'get_user']);
  Route::get('profile', [ApiController::class, 'profile']);
  Route::get('getAuthUser', [ApiController::class, 'getAuthUser']);
    Route::get('detail', [ApiController::class, 'detail']);
  // Route::get('products', [ProductController::class, 'index']);
  // Route::get('products/{id}', [ProductController::class, 'show']);
  // Route::post('create', [ProductController::class, 'store']);
  // Route::put('update/{product}',  [ProductController::class, 'update']);
  // Route::delete('delete/{product}',  [ProductController::class, 'destroy']);
});

//===================================================================================

Route::group([ 'middleware' => ['api'],
'prefix' => 'member'], static function ($router) {
  Route::post('login', 'ApiController@login');
  Route::post('register', 'ApiController@register');
  Route::group(['middleware' => 'jwt.verify'], static function( $router){
    Route::post('logout', 'ApiController@logout');
    Route::post('refresh', 'ApiController@refresh');
    Route::get('detail', 'ApiController@detail'); });
  });



  //=============================================================
  Route::group(
    [
      'middleware' => 'api',
      'namespace'  => 'App\Http\Controllers',
      'prefix'     => 'auth',
    ],
    function ($router) {

      Route::get('userProfile', [AuthController::class, 'userProfile']);
      Route::get('refresh', [AuthController::class, 'refresh']);
      Route::get('profile', [AuthController::class, 'profile']);
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('register', [AuthController::class, 'register']);
      Route::get('login', [AuthController::class, 'login']);
      Route::get('userProfile', [AuthController::class, 'userProfile']);
      Route::get('getAuthUser', [AuthController::class, 'getAuthUser']);
      Route::get('getLogUser', [AuthController::class, 'getLogUser']);
    }
  );
  //=============================================================

    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'authenticate']);
    Route::get('open', [DataController::class, 'open']);
    Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
    Route::get('closed', [DataController::class, 'closed']);
  });

  //============================================================================





  Route::get('users', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return User::all();
  });



  Route::post('users', function(Request $request) {
    $user = User::create($request->all());
    return $user;
  });



  Route::get('user-create', function(Request $request) {
    App\User::create([
      'name'=>'adi',
      'email'=>'adi@adi.adi',
      'password'=>Hash::make('adiadiadiadi')

    ]);
  });

  Route::get('/login', function() {
    $credentials= $request()->only(['email','password']);
    $token = auth()->attemp($credentials);
    return token;

  });


  //=================================/api/user===========================================

  // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //    return $request->user();
  // });

  // Route::middleware('auth')->get('/user',function (Request $request){
  // return $request->user();
  // });
  $payload = JWTFactory::sub(123)->aud('foo')->foo(['bar' => 'baz'])->make();
  $token = JWTAuth::encode($payload);
  Route::middleware('auth:api')->get('/me?token={"'.$token.'"}',function (Request $request){
    return auth()->user();
  });

  //===================================================================================

  Route::get('product', function(Request $request) {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
//
//     $payload = JWTFactory::sub(123)->aud('foo')->foo(['bar' => 'baz'])->make();
//     $token = JWTAuth::encode($payload);
//
// dd($token);


    $user = JWTAuth::parseToken()->authenticate();
    $user=auth()->guard('api')->user();
    dd($user);
    dd($user);


$token = JWTAuth::getToken();
dd($token);

$user = JWTAuth::parseToken()->authenticate();
dd($user);

    // some user
    $user = User::first();

    $token = JWTAuth::fromUser($user);

  dd($token);


    $user =  JWTAuth::toUser($request->input('token')); //JWTAuth::authenticate($request->token);
  $user =  response()->json($this->guard()->user());
    dd($user);

    return response()->json($this->guard()->user());
return response()->json(auth()->user());
return Auth::guard();



    if ($request->has('token')) {
      try {
        dd($request->input('token'));
        $this->auth = JWTAuth::parseToken()->authenticate();
        return $next($request);
      } catch (JWTException $e) {
        return redirect()->guest('user/login');
      }




      $user=auth()->guard('api')->user();
      dd($user);
      return User::all();

    }

  });
//=======================================================================
  // Route::get('/user', function (Request $request) {
  //
  //   $my_response = $request('GET', '/api/logout', [
  //       'headers' => [
  //           'Accept' => 'application/json',
  //           'Authorization' => 'Bearer '.$accessToken,
  //       ],
  //   ]);
  // }

  //   Route::post('users', function(Request $request) {
  //       $user = User::create($request->all());
  //       return $user;
  //
  //
  //
  //
  //
  //    dd($my_response);
  //  dd($request->user());
  // });

  // Route::get('/product', function() {
  //   $currentUser =  Auth::guard('api')->user()->id ;//Auth::user();
  //
  //   dd($currentUser);
  //
  //   try {
  //       // verify the credentials and create a token for the user
  //       if (! $token = JWTAuth::attempt($credentials)) {
  //           return response()->json(['error' => 'invalid_credentials'], 401);
  //       }
  //   } catch (JWTException $e) {
  //       // something went wrong
  //       return response()->json(['error' => 'could_not_create_token'], 500);
  //   }
  //
  //
  //
  //
  //
  //
  //
  //    $id = 1;//Auth::user()->id;
  //         if (!Auth::user()) {
  //     }else{
  //         return Task::all();
  //     }
  // });



  // Route::get('tasks', function() {
  //     // If the Content-Type and Accept headers are set to 'application/json',
  //     // this will return a JSON structure. This will be cleaned up later.
  //     $user = User::find(1);
  //       return $user->tasks;
  //
  //     return Task::all();
  //
  //
  //
  // });





  Route::get('tasks', function() {

    try {
        $user = auth()->userOrFail();
        return $user->tasks;
    } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
        // do something
        return Task::all();
    }




  });










  Route::get('tasks', function() {
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
