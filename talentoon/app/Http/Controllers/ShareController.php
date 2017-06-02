<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryShareService;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
class ShareController extends Controller
{
    //
 public function store(Request $request)
    {
        $user= JWTAuth::parseToken()->toUser();
        $response=CategoryShareService::share($request,$user->id);
        return $response;
    }
}
