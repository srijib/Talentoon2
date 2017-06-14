<?php

namespace App\Http\Controllers\JWTAuth;

use App\Models\User;
use App\Models\Role;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller {

    public function register(Request $request) {
        if (User::where('email', $request['email'])->first()) {
            return response()->json([
                        'status' => "wrong",
                        'message' => "User already registered, try logging in",
            ]);
        } else {
            if (!User::create([
                        'first_name' => $request['first_name'],
                        'last_name' => $request['last_name'],
                        'phone' => $request['phone'],
                        'country_id' => $request['country_id'],
                        'gender' => $request['gender'],
                        'date_of_birth' => $request['date_of_birth'],
                        'image' => 'uploads/profile_pic/'.$request['image'],
                        'email' => $request['email'],
                        'password' => Hash::make($request['password'])
                    ])) {
                return response()->json([
                            'status' => "wrong",
                            'message' => "Couldn't create User",
                ]);
            } else {
                //assigning audience role by default to the registering user
                $role = Role::where('name', '=','audience')->first();
                //dd($role);
                $user = User::where('email', '=', $request->input('email'))->first();
               //return($user);
                //return($role->id);
                $user->attachRole($role);
               // $user->roles()->attach($role->id);

                return response()->json([
                            'status' => "ok",
                            'message' => "User Created Successfully",
                            'role'=>"audience",
                            'user'=>$user
                ]);
            }
        }
    }

}
