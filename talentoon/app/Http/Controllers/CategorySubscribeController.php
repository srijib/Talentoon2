<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategorySubscribeService;


class CategorySubscribeController extends Controller
{
    //
    public function store(Request $request){
        // return response()->json(['status' => $request,'message' => 'data saved successfully']);

     $response=CategorySubscribeService::subscribe($request);
     return $response;


    }
    public function update(Request $request){

     $response=CategorySubscribeService::unsubscribe($request);
     return $response;

}
}
