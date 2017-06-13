<?php

require('GCMPushMessage.php');
echo $_GET['id'];
$apiKey = $_GET['apikey'];
$message="you have recieved new notifiction";
$data='additional data may be sent';
$gcpm=new GCMPushMessage($apikey);
$gcpm->setDevices(array($_GET['id']));
$response=$gcpm->send($message,array('title'=>'welcome','data'=>''));
echo "<br>".$response;

?>
