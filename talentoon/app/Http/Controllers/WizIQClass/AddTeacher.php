<?php

namespace App\Http\Controllers\WizIQClass;
use Illuminate\Http\Request;

class AddTeacherClass
{

    public function __construct($secretAcessKey,$access_key,$webServiceUrl,Request $request){

        //Nada This Code to add a new teacher with API
        //And get the response to be Teacher_ID
        //Teacher id in order to be used in any create class
        //Because our account is room based account.
//        require_once("AuthBase.php");
        $authBase = new AuthBase($secretAcessKey,$access_key);
        $method = "add_teacher";
        $requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
        $requestParameters["name"] = "Magda ";
        $requestParameters["email"]="magda.bayoumy@gmail.com";
        $requestParameters["password"]="123456";

        $httpRequest=new HttpRequest();
        try
        {
            $XMLReturn = $httpRequest->wiziq_do_post_request($webServiceUrl.'?method=add_teacher',http_build_query($requestParameters, '', '&'));

//
//            $xml = simplexml_load_string($XMLReturn);
//            $json = json_encode($xml);
//
//
//            print_r($json);


            $xml_cnt = $XMLReturn;
            $xml_cnt = str_replace(array("\n", "\r", "\t"), '', $xml_cnt);    // removes newlines, returns and tabs

            // replace double quotes with single quotes, to ensure the simple XML function can parse the XML
            $xml_cnt = trim(str_replace('"', "'", $xml_cnt));
            $simpleXml = simplexml_load_string($xml_cnt);


//            var_dump(json_encode($simpleXml));
            echo json_encode($simpleXml);    // returns a string with JSON object
//

//            echo XMLtoJSON($XMLReturn);

//
//            $array = json_decode($json,TRUE);
//
//
//
//
//
////            var_dump($XMLReturn);
////            return json_encode($XMLReturn);
////            $returnxml = simplexml_load_string($XMLReturn);
//
////            var_dump($returnxml);
////            var_dump($returnxml["@attributes"][0]["status"]);
////            return json_encode($returnxml["@attributes"][0]["status"]);
////            print_r($returnxml->attributes('status',true));
//
//            print_r($array);
//            return  $returnxml->getName('call_id');
//            $json = json_encode($return);
//            $array = json_decode($json,TRUE);
////            echo ($json);
////            print_r($array);
//
//            if($array['@attributes']['status'] == "fail"){
//
//                echo $array['error']['@attributes']['code']+"";
//                return $array['error']['@attributes']['code']+"";
//            }
//            else{
//                echo $array['@attributes']['status']+"";
//                return $array['@attributes']['status']+"";
//            }

//            return json ($array['@attributes']['status']);
//            exit();
        }
        catch(Exception $e)
        {
            echo "d5l exception";
//            var_dump($e);
            echo json_encode($e->getMessage());
//            print_r($e);

        }
        //End Nada New Teacher API

    }



    public static function XMLtoJSON($xml) {
        $xml_cnt = file_get_contents($xml);    // gets XML content from file
        $xml_cnt = str_replace(array("\n", "\r", "\t"), '', $xml_cnt);    // removes newlines, returns and tabs

        // replace double quotes with single quotes, to ensure the simple XML function can parse the XML
        $xml_cnt = trim(str_replace('"', "'", $xml_cnt));
        $simpleXml = simplexml_load_string($xml_cnt);

        return json_encode($simpleXml);    // returns a string with JSON object
    }




}
?>