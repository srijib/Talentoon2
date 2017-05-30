<?php
header("Content-type:text/xml");
class Delete
{
 function Delete($secretAcessKey,$access_key,$webServiceUrl)
 {
    require_once("AuthBase.php");
    $authBase = new AuthBase($secretAcessKey,$access_key);
    $method = "delete";
    $requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
    $requestParameters["content_id"] = "13210";//Required
    $httpRequest=new HttpRequest();
    try
    {
            $XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=delete',http_build_query($requestParameters, '', '&'));
    }
    catch(Exception $e)
    {
            echo $e->getMessage();
    }
    if(!empty($XMLReturn))
    {
        print $XMLReturn;
    }
    else
        echo "<response>Empty Response</response>";
 }
}
?>