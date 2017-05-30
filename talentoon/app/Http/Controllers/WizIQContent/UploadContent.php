<?php
header("Content-type:text/xml");
require_once("AuthBase.php");
$secretAcessKey = $_REQUEST['secretAcessKey'];
$access_key = $_REQUEST['access_key'];
$webServiceUrl = $_REQUEST['webServiceUrl'];
$requestParameters = array();
$authBase = new AuthBase($secretAcessKey, $access_key);
$method = "upload";
$requestParameters["signature"] = $authBase->GenerateSignature($method, $requestParameters);
$requestParameters["title"] = "Mathematics";
//#for teacher account pass parameter 'presenter_email'
//This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
//this presenter email to your organization�s teacher account. � For more information visit at: (http://developer.wiziq.com/faqs)
$requestParameters.Add("presenter_email", "nada1990.bayoumy@gmail.com");
// Optional parameters
#for room based account pass parameters 'presenter_id', 'presenter_name'
//$requestParameters.Add("presenter_id", "123");
//$requestParameters.Add("presenter_name", "ramesh");
//$requestParameters.Add("presenter_id", "578");
//$requestParameters.Add("presenter_name", "David");
//$requestParameters.Add("folder_path","Ram/Sham");
//$requestParameters.Add("access_level","1");
//$requestParameters.Add("return_url","");
//$requestParameters.Add("status_ping_url","");
$fname = $_REQUEST['filename'];
$url = $webServiceUrl."?method=".$method;
postfile($url, $fname, $requestParameters);


function postfile($url, $filepath, $requestParameters)
{
    if (file_exists($filepath))
    {
        $size = filesize($filepath);
        $fp = fopen($filepath, 'r');
        if (!$fp)
        {
            echo '<response>Cannot open file= ' . $filepath.'</response>';
            return;
        }
        if (!is_numeric($size))
        {
            echo '<response>File is empty</response>';
            return;
        }
    } 
    else
    {
        echo '<response>File Not found= ' . $filepath.'</response>';
        return;
    }
    $filapath = "@$filepath";
    $requestParameters["file"] = $filapath;
    $cur = curl_init($url);
    curl_setopt($cur, CURLOPT_POST, 1);
    curl_setopt($cur, CURLOPT_POSTFIELDS, $requestParameters);
    curl_setopt($cur, CURLOPT_INFILESIZE, $size);
    curl_setopt($cur,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($cur, CURLOPT_INFILE, $fp);
    $response = curl_exec($cur);
    curl_close($cur);
    fclose($fp);
    if(!empty ($response))
    print $response;
    else
    echo "<response>Empty Response</response>"; 
}

?>