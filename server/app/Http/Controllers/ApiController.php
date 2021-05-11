<?php
namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;



use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Hash;




use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;




class ApiController extends Controller
{

  protected $data = [];

  public function __construct()
  {
    $this->data = [
      'status' => false,
      'code' => 401,
      'data' => null,
      'err' => [
        'code' => 1,
        'message' => 'Unauthorized'
      ]
    ];
  }



  //========================================================================================
  /**
  * Render an exception into an HTTP response.
  *
  * @param Request $request
  * @param \Exception $exception
  * @return Response
  */

  public function render($request, Exception $exception) :Response
  {
    if ($exception instanceof UnauthorizedHttpException) {
      $preException = $exception->getPrevious();
      if ($preException instanceof
      TokenExpiredException) {
        return response()->json([
          'data' => null,
          'status' => false,
          'err_' => [
            'message' => 'Token Expired',
            'code' =>1
          ]
        ]
      );
    }
    else if ($preException instanceof
    TokenInvalidException) {
      return response()->json([
        'data' => null,
        'status' => false,
        'err_' => [
          'message' => 'Token Invalid',
          'code' => 1
        ]
      ]
    );
  } else if ($preException instanceof
  TokenBlacklistedException) {
    return response()->json([
      'data' => null,
      'status' => false,
      'err_' => [
        'message' => 'Token Blacklisted',
        'code' => 1
      ]
    ]
  );
}
if ($exception->getMessage() === 'Token not provided') {
  return response()->json([
    'data' => null,
    'status' => false,
    'err_' => [
      'message' => 'Token not provided',
      'code' => 1
    ]
  ]
);
}else if( $exception->getMessage() === 'User not found'){
  return response()->json([
    'data' => null,
    'status' => false,
    'err_' => [
      'message' => 'User Not Found',
      'code' => 1
    ]
  ]
);
}
}
return parent::render($request, $exception);
}


//=============================================================================================

public function register(Request $request)
{
  //Validate data
  $data = $request->only('name', 'email', 'password');
  $validator = Validator::make($data, [
    'name' => 'required|string',
    'email' => 'required|email|unique:users',
    'password' => 'required|string|min:6|max:50'
  ]);

  //Send failed response if request is not valid
  if ($validator->fails()) {
    return response()->json(['error' => $validator->messages()], 200);
  }

  //Request is valid, create new user
  $user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => bcrypt($request->password)
  ]);

  //User created, return success response
  return response()->json([
    'success' => true,
    'message' => 'User created successfully',
    'data' => $user
  ], Response::HTTP_OK);
}
//=============================================================================================
public function authenticate(Request $request)
{
  $credentials = $request->only('email', 'password');

  //valid credential
  $validator = Validator::make($credentials, [
    'email' => 'required|email',
    'password' => 'required|string|min:6|max:50'
  ]);

  //Send failed response if request is not valid
  if ($validator->fails()) {
    return response()->json(['error' => $validator->messages()], 200);
  }

  //Request is validated
  //Crean token
  try {
    if (! $token = JWTAuth::attempt($credentials)) {
      return response()->json([
        'success' => false,
        'message' => 'Login credentials are invalid.',
      ], 400);
    }
  } catch (JWTException $e) {
    return $credentials;
    return response()->json([
      'success' => false,
      'message' => 'Could not create token.',
    ], 500);
  }

  //Token created, return with success response and jwt token
  return response()->json([
    'success' => true,
    'token' => $token,
  ]);
}
//=============================================================================================
public function logout(Request $request)
{
  //valid credential
  $validator = Validator::make($request->only('token'), [
    'token' => 'required'
  ]);

  //Send failed response if request is not valid
  if ($validator->fails()) {
    return response()->json(['error' => $validator->messages()], 200);
  }

  //Request is validated, do logout
  try {
    JWTAuth::invalidate($request->token);

    return response()->json([
      'success' => true,
      'message' => 'User has been logged out'
    ]);
  } catch (JWTException $exception) {
    return response()->json([
      'success' => false,
      'message' => 'Sorry, user cannot be logged out'
    ], Response::HTTP_INTERNAL_SERVER_ERROR);
  }
}
//=============================================================================================
public function get_user(Request $request)
{

  $this->validate($request, [
    'token' => 'required'
  ]);

  $user = JWTAuth::authenticate($request->token);

  return response()->json(['user' => $user]);
}
//======================================================================
public function profile()
{
  return response()->json($this->guard()->user());

}//end profile()

//=====================================================================================
public function getAuthUser(Request $request)
  {
      return response()->json(auth()->user());
  }
//=====================================================================================
protected function guard()
{
  return Auth::guard();

}//end guard()

//=============================================================================================



}
