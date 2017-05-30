<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    //
    public function __constract(){
      $this->middleware('guest:admin');
    }
    public function showLoginForm(){
      return view("auth.admin-login");
    }

    public function login(Request $request){
      // return true;
      //validate form data
      $this->validate($request, [
         'email' => 'required|email',
         'password' => 'required|min:6',
     ]);

      //attempt to log the user in this function return true or false
      //guard used to authenticate and register users
      //if authentication attempt is successful and the user is logged in
      if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
      //if scusess ,then redirect to intented location
      //function will redirect the user to the URL they
      // were trying to access before being caught by the authentication filter.
      return redirect()->intended(route('admin.dashboard'));

      }

      //if un sucess ,then redirect back to login with the form data
      return redirect()->back()->withInput($request->only('email','remember'));
    }
}
