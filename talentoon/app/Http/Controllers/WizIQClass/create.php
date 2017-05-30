<?php
class ScheduleClass
{

    public function __construct($secretAcessKey,$access_key,$webServiceUrl){



        //Nada This Code to add a new teacher with API
        //And get the response to be Teacher_ID
        //Teacher id in order to be used in any create class
        //Because our account is room based account.
//        require_once("AuthBase.php");
//        $authBase = new AuthBase($secretAcessKey,$access_key);
//        $method = "add_teacher";
//        $requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
//        $requestParameters["name"] = "Nada ";
//        $requestParameters["email"]="nada1990.bayoumy@gmail.com";
//        $requestParameters["password"]="123456";
//
//        $httpRequest=new HttpRequest();
//        try
//        {
//            $XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=add_teacher',http_build_query($requestParameters, '', '&'));
//            echo ($XMLReturn);
//            exit();
//        }
//        catch(Exception $e)
//        {
//            echo $e->getMessage();
//        }
        //End Nada New Teacher API









        require_once("AuthBase.php");
        $authBase = new AuthBase($secretAcessKey,$access_key);
        $method = "create";
        $requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);

        #for teacher account pass parameter 'presenter_email'
        //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
        //this presenter email to your organization�s teacher account. � For more information visit at: (http://developer.wiziq.com/faqs)
        $requestParameters["presenter_email"]="nada1990.bayoumy@gmail.com";
//        $requestParameters["presenter_email"]="kerrygun@gmail.com";
        #for room based account pass parameters 'presenter_id', 'presenter_name'
        $requestParameters["presenter_id"] = "229733";
        $requestParameters["presenter_name"] = "Nada";

        $requestParameters["start_time"] = "2017-05-26 17:40";
        $requestParameters["title"]="Second Music Class"; //Required
        $requestParameters["duration"]=""; //optional
//        $requestParameters["time_zone"]="Asia/Kolkata"; //optional
        $requestParameters["attendee_limit"]="10"; //optional
        $requestParameters["control_category_id"]=""; //optional
        $requestParameters["create_recording"]=""; //optional
        $requestParameters["return_url"]=""; //optional
        $requestParameters["status_ping_url"]=""; //optional
        $requestParameters["language_culture_name"]="en-us";



        $httpRequest=new HttpRequest();
        try
        {
            $XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=create',http_build_query($requestParameters, '', '&'));

        }
        catch(Exception $e)
        {
            echo $e->getMessage();

        }
        if(!empty($XMLReturn))
        {
            try
            {
                $objDOM = new DOMDocument();
                $objDOM->loadXML($XMLReturn);

            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
            $status=$objDOM->getElementsByTagName("rsp")->item(0);
            $attribNode = $status->getAttribute("status");
            if($attribNode=="ok")
            {
                $methodTag=$objDOM->getElementsByTagName("method");
                echo "method=".$method=$methodTag->item(0)->nodeValue;
                $class_idTag=$objDOM->getElementsByTagName("class_id");
                echo "<br>Class ID=".$class_id=$class_idTag->item(0)->nodeValue;
                $recording_urlTag=$objDOM->getElementsByTagName("recording_url");
                echo "<br>recording_url=".$recording_url=$recording_urlTag->item(0)->nodeValue;
                $presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
                echo "<br>presenter_email=".$presenter_email=$presenter_emailTag->item(0)->nodeValue;
                $presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
                echo "<br>presenter_url=".$presenter_url=$presenter_urlTag->item(0)->nodeValue;
            }
            else if($attribNode=="fail")
            {
                $error=$objDOM->getElementsByTagName("error")->item(0);
                echo "<br>errorcode=".$errorcode = $error->getAttribute("code");
                echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");
            }
        }//end if


    }



	function ScheduleClass($secretAcessKey,$access_key,$webServiceUrl)
	{
//	    exit("in schedule class");
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "create";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
                //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
                //this presenter email to your organization�s teacher account. � For more information visit at: (http://developer.wiziq.com/faqs)
        $requestParameters["presenter_email"]="mina.zakaria.iti@gmail.com";
//        $requestParameters["presenter_email"]="kerrygun@gmail.com";
		#for room based account pass parameters 'presenter_id', 'presenter_name'
		//$requestParameters["presenter_id"] = "40";
		//$requestParameters["presenter_name"] = "vinugeorge";  
		$requestParameters["start_time"] = "2017-12-25 11:55";
		$requestParameters["title"]="my php-class"; //Required
		$requestParameters["duration"]=""; //optional
		$requestParameters["time_zone"]="Asia/Kolkata"; //optional
		$requestParameters["attendee_limit"]=""; //optional
		$requestParameters["control_category_id"]=""; //optional
		$requestParameters["create_recording"]=""; //optional
		$requestParameters["return_url"]=""; //optional
		$requestParameters["status_ping_url"]=""; //optional
                $requestParameters["language_culture_name"]="en-us";
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=create',http_build_query($requestParameters, '', '&')); 
		}
		catch(Exception $e)
		{	
	  		echo $e->getMessage();
		}
 		if(!empty($XMLReturn))
 		{
 			try
			{
			  $objDOM = new DOMDocument();
			  $objDOM->loadXML($XMLReturn);
	  
			}
			catch(Exception $e)
			{
			  echo $e->getMessage();
			}
		$status=$objDOM->getElementsByTagName("rsp")->item(0);
    	$attribNode = $status->getAttribute("status");
		if($attribNode=="ok")
		{
			$methodTag=$objDOM->getElementsByTagName("method");
			echo "method=".$method=$methodTag->item(0)->nodeValue;
			$class_idTag=$objDOM->getElementsByTagName("class_id");
			echo "<br>Class ID=".$class_id=$class_idTag->item(0)->nodeValue;
			$recording_urlTag=$objDOM->getElementsByTagName("recording_url");
			echo "<br>recording_url=".$recording_url=$recording_urlTag->item(0)->nodeValue;
			$presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
			echo "<br>presenter_email=".$presenter_email=$presenter_emailTag->item(0)->nodeValue;
			$presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
			echo "<br>presenter_url=".$presenter_url=$presenter_urlTag->item(0)->nodeValue;
		}
		else if($attribNode=="fail")
		{
			$error=$objDOM->getElementsByTagName("error")->item(0);
   			echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
   			echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");	
		}
	 }//end if	
   }//end function
	
}
?>