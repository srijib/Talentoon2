<?php
header("Content-type:text/xml");
class Listing
{
 function Listing($secretAcessKey,$access_key,$webServiceUrl)
 {
    require_once("AuthBase.php");
    $authBase = new AuthBase($secretAcessKey,$access_key);
    $method = "list";
    $requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
    $requestParameters["page_number"] = "1";//optional
    $requestParameters["page_size"] = "10";//optional
    $httpRequest=new HttpRequest();
    try
    {
            $XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=list',http_build_query($requestParameters, '', '&'));
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