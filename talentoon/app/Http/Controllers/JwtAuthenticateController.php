<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Log;

class JwtAuthenticateController extends Controller {

    public function index() {
        return response()->json(['auth' => Auth::user(), 'users' => User::all()]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function createRole(Request $request) {
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description  = $request->input('description');
        $role->save();

        return response()->json(["message"=>"Role added Successfully"],201);
     
    }

    public function createPermission(Request $request) {
        //change it later to $permission 
        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->display_name=$request->input('display_name');
        // Allow a user to...
        $permission->description=$request->input('description');
        $permission->save();

        return response()->json(["message"=>"Permission added successfully"],201);  
    }

    public function assignRole(Request $request) {
        $user = User::where('email', '=', $request->input('email'))->first();

        $role = Role::where('name', '=', $request->input('role'))->first();
        //$user->attachRole($request->input('role'));
        // or eloquent's original technique
        $user->roles()->attach($role->id);

        return response()->json(["message"=>"Role assigned successfully"],201); 
    }

    public function attachPermission(Request $request) {
       
        $role = Role::where('name', '=', $request->input('role'))->first();
        $permission = Permission::where('name', '=', $request->input('name'))->first();
        $role->attachPermission($permission);

        return response()->json(["message"=>"Permission attached successfully"],201);
    }      
    

}
