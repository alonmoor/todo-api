<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;



use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Http\JsonResponse;





use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;



//

class AuthController extends Controller
{
    //=====================================================================================


    public function __construct()
      {
          $this->middleware('auth');
      }
  //=====================================================================================

      public function authenticate(Request $request)
         {
             // grab credentials from the request
             $credentials = $request->only('email', 'password');

             try {
                 // attempt to verify the credentials and create a token for the current user
                 if (! $token = JWTAuth::attempt($credentials)) {
                     return response()->json(['error' => 'invalid_credentials'], 401);
                 }
             } catch (JWTException $e) {
                 // error while attempting to encode token
                 return response()->json(['error' => 'could_not_create_token'], 500);
             }

             // all good, return the token
             return response()->json(compact('token'));
         }

  //=====================================================================================

    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
  //=====================================================================================
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
  //=====================================================================================
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
  //=====================================================================================
    // public function getAuthUser(Request $request)
    //   {
    //       return response()->json(auth()->user());
    //   }



    // somewhere in your controller
public function getAuthUser()
{
    try {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        return response()->json(['token_expired'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        return response()->json(['token_invalid'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['token_absent'], $e->getStatusCode());
    }
    // Token is valid and we have found the user via the sub claim
    return response()->json(compact('user'));
}
    //=====================================================================================
  public function getLogUser(Request $request){

      $credentials = $request->only('email', 'password');
      try {
          // verify the credentials and create a token for the user
          if (! $token = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'invalid_credentials'], 401);
          }
      } catch (JWTException $e) {
          // something went wrong
          return response()->json(['error' => 'could_not_create_token'], 500);
      }

       return Auth::user();
    }
}
