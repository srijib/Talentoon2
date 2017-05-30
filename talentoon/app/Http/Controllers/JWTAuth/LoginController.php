<?php

namespace App\Http\Controllers\JWTAuth;

use App\Models\User;
use JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {

    public function login(Request $request, JWTAuth $JWTAuth) {
        $RegisteredUser = User::where('email', $request['email'])->first();
        //dd($RegisteredUser->password);
        if (!$RegisteredUser) {
            return response()->json([
                        'status' => 'wrong',
                        'message' => 'User Not Registered, Try Signing Up'
            ]);
        } else {
            if (!Hash::check($request['password'], $RegisteredUser->password)) {
                return response()->json([
                            'status' => 'wrong',
                            'message' => 'Password is Incorrect'
                ]);
            } else {
                $credentials = $request->only(['email', 'password']);
                //dd($credentials);
                try {
                        $token = JWTAuth::attempt($credentials);
                        //dd($token);
                        if (!$token) {
                            throw new AccessDeniedHttpException();
                        }
                        //$user= JWTAuth::parseToken()->toUser();

                } catch (JWTException $e) {
                    throw new HttpException(500);
                }

                return response()
                                ->json([
                                    'status' => 'ok',
                                    'message'=>'User Authenticated SUccessfully',
                                    'token' => $token,
                                    'user' => $RegisteredUser
                ]);
            }
        }
    }

}
