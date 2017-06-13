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
use App\Services\Notification;
use Berkayk\OneSignal;


class LoginController extends Controller {

    public function login(Request $request, JWTAuth $JWTAuth) {

//        OneSignal::sendNotificationToAll("welcome to Talentooooon !", $url = null, $data = null);
        $RegisteredUser = User::where('email', $request['email'])->first();
//        dd($RegisteredUser->password);
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
            } else if($RegisteredUser->is_active==1) {
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
//                $notify = new Notification();
//                $n=$notify->sendMessageAll();


//                OneSignal::sendNotificationToAll("welcome to Talentooooon !", $url = null, $data = null);
//                return response()->json($n);

//                return response()
//                    ->json(
//                        $n
//                    );

                $response=array(
                    'status' => 'ok',
                    'message'=>'User Authenticated SUccessfully',
                    'token' => $token,
                    'user' => $RegisteredUser,
                );
//                return $n;
//                $result=array_merge(json_decode($n, true),$response);
//                $result=json_encode(array_merge($response,json_decode($n, true)));
                return $response;
            }else{
                $response=array(
                    'status' => 'wrong',
                    'message'=>'blocked user'

                );
                return $response;
            }
        }
    }

}
