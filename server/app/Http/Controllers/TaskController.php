<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Task;


class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $user;

      public function __construct()
      {
        $this->user = JWTAuth::parseToken()->authenticate();
      }

//==================================================================================
       public function index(Request $request)
       {


//  $user = JWTAuth::User();
//
// dd( $user);
//
//                 $user = JWTAuth::user();
//
//          $currentUser = Auth::user();
//


  //
  //        try {
  //                    $user = JWTAuth::parseToken()->authenticate();
  //                     } catch (Exception $e) {
  //                    if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
  //                        return response()->json(['code'=>404,'message' => 'Token is Invalid'],404);
  //                    }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
  //                        return response()->json(['code'=>404,'message' => 'Token is Expired'],404);
  //                    }else{
  //                        return response()->json(['code'=>404,'status' => 'Authorization Token not found']);
  //                    }
  //                }
  //
  // dd($user);








         // $this->validate($request, [
         //                        'email'    => 'required|email|max:255',
         //                        'password' => 'required'
         //                    ]);
         //
         //                    try
         //                    {
         //                        if (!$this->token = $this->jwt->attempt($request->only('email', 'password'))):
         //                            throw new HttpResponseException(response()->json(['message' => 'Email/Contraseña invalidos'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
         //                        endif;
         //                    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e)
         //            {
         //                throw new HttpResponseException(response()->json(['message' => 'Token expirado'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
         //            }
         //            catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
         //            {
         //                throw new HttpResponseException(response()->json(['message' => 'Token invalido'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
         //            }
         //            catch (\Tymon\JWTAuth\Exceptions\JWTException $e)
         //            {
         //                throw new HttpResponseException(response()->json(['message' => 'Sin token'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
         //            }
         //            return response()->json([
         //                "token" => $this->token,
         //                "email" => $this->jwt->user()->email,
         //                "rfc" => $this->jwt->user()->rfc,
         //                "nombre" => $this->jwt->user()->nombre,
         //                "_uof" => $this->Cipher->EncryptCipher($this->jwt->user()->id),
         //                "_rof" => $this->Cipher->EncryptCipher($this->jwt->user()->rfc)
         //            ], 200);
                //}
                // catch(Exception $error)
                // {
                //     throw new HttpResponseException(response()->json(['message' => 'Error al iniciar sesión el usuario'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
                // }


         // dd($currentUser);
         //
         //
         //
         //
         // $credentials = $request->only('email', 'password');
         // try {
         //     // verify the credentials and create a token for the user
         //     if (! $token = JWTAuth::attempt($credentials)) {
         //         return response()->json(['error' => 'invalid_credentials'], 401);
         //     }
         // } catch (JWTException $e) {
         //     // something went wrong
         //     return response()->json(['error' => 'could_not_create_token'], 500);
         // }
         //
         // $currentUser = Auth::user();
         //
         // dd($currentUser);
         // print_r($currentUser);exit;
         //
         //
         //  return Task::all();
         //
         //  $user = $this->user->tasks()->get();
         //
         //  print_r($user);
         //
         //            return $this->user
         //                        ->tasks()
         //                        ->get();

       }

//==================================================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
//==================================================================================
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
//==================================================================================
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        //var_dump($task->tasks);
        return view('users.show')->with('user',$task);
    }
//==================================================================================
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
//==================================================================================
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
//==================================================================================
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
//==================================================================================
}
