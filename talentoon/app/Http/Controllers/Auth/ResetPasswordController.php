<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'http://talentoon.com/#!/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // public function showResetForm(Request $request)
    // {
    //     // dd('testtttt');
    //     if ($response === Password::RESET_LINK_SENT) {
    //         return response()->json(['trans'=> trans($response),'status' => '1','message' => 'An Email has been sent to your email to varify your password']);
    //         // return back()->with('status', trans($response));
    //     }
    //     // If an error was returned by the password broker, we will get this message
    //     // translated so we can notify a user of the problem. We'll redirect back
    //     // to where the users came from so they can attempt this process again.
    //     return response()->json(['email'=> trans($response),'status' => '0','message' => 'there is a problem']);
    //
    //     // return back()->withErrors(
    //     //     ['email' => trans($response)]
    //     // );
    // }
}
