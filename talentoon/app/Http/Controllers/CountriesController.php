<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountriesController extends Controller
{
    public function getAllCountries(Request $request) {
        //dd($request->all());
        $countries=Country::all();
        return response()->json([
            'status'=>'ok',
            'data'=>$countries
            
        ]);
    }
}
