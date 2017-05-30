<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryShareService;


class ShareController extends Controller
{
    //
 public function store(Request $request)
    {
        $response=CategoryShareService::share($request);
        return $response;
    }
}
