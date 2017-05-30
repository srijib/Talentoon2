<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryTalentService;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class CategoryTalentController extends Controller
{
    public $service;
    public function __construct(CategoryTalentService $service) {
        $this->service = $service;
    }
    public function store(Request $request){
        $user= JWTAuth::parseToken()->toUser();
        //return $user;
        $talent = $this->service->beTalent($user,
                $request->category_id, $request->from_when, $request->description);

        return response()->json($talent, 201);
    }

    public function update(Request $request) {
        $CTS_Obj=new CategoryTalentService();

        $response=$CTS_Obj->mentorApprove($request);
        return $response;
    }
}
