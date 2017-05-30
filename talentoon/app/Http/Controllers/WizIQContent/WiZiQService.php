<?php

$secretAcessKey="FBFV/pmYckcfbbu3XkuEWg==";
$access_key="nO+b3dHN0/o=";
$webServiceUrl="http://content.api.wiziq.com/RestService.ashx";
		
require_once("file.php");
//$obj=new file($secretAcessKey,$access_key,$webServiceUrl);

require_once("Delete.php");
//$obj=new Delete($secretAcessKey,$access_key,$webServiceUrl);

require_once("List.php");
$obj=new Listing($secretAcessKey,$access_key,$webServiceUrl);
?>