<?php

namespace App\Http\Controllers\WizIQClass;
use Illuminate\Http\Request;

class EditTeacherClass
{

    public function __construct($secretAcessKey,$access_key,$webServiceUrl,Request $request){

        //Nada This Code to add a new teacher with API
        //And get the response to be Teacher_ID
        //Teacher id in order to be used in any create class
        //Because our account is room based account.
//        require_once("AuthBase.php");
        $authBase = new AuthBase($secretAcessKey,$access_key);
        $method = "edit_teacher";
        $requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
        $requestParameters["teacher_id"] = "1 ";
        $requestParameters["name"] = "Nada ";
        $requestParameters["email"]="nada.bayoumy@gmail.com";
        $requestParameters["password"]="123456";

        $httpRequest=new HttpRequest();
        try
        {
            $XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=edit_teacher',http_build_query($requestParameters, '', '&'));
            echo ($XMLReturn);
//            exit();
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        //End Nada New Teacher API

    }
}
?>