<?php
namespace App\Services;

    class Notification{
        //to all users
    public function sendMessageAll(){
            $content = array(
                "en" => 'Wellcome to Talentoooon :D'
            );

            $fields = array(
                'app_id' => "5e0081b4-a54d-46be-b6bb-a42fa5af576b",
                'included_segments' => array('All'),
                'data' => array("foo" => "bar"),
                'contents' => $content
            );

            $fields = json_encode($fields);
//            print("\nJSON sent:\n");
//            print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                'Authorization: Basic OTI5YTJjNWUtNjdmZi00Njg1LWI5ZjMtZmNlOTRjY2NhYmM4'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
    }

        //add device

//send to spesific user
        function sendMessage(){
            $content = array(
                "en" => 'English Message'
            );

            $fields = array(
                'app_id' => "5eb5a37e-b458-11e3-ac11-000c2940e62c",
                'included_segments' => array('Active Users'),
                'data' => array("foo" => "bar"),
                'contents' => $content
            );

            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                'Authorization: Basic OTI5YTJjNWUtNjdmZi00Njg1LWI5ZjMtZmNlOTRjY2NhYmM4'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        }
        //add device

        //send based on filter like competitions
        function sendMessageFilter(){
            $content = array(
                "en" => 'posted in category'
            );

            $fields = array(
                'app_id' => "5e0081b4-a54d-46be-b6bb-a42fa5af576b",
                'filters' => array(array("field" => "tag", "key" => "gender", "relation" => "=", "value" => "male")),
                'data' => array("foo" => "bar"),
                'contents' => $content
            );

            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                'Authorization: Basic OTI5YTJjNWUtNjdmZi00Njg1LWI5ZjMtZmNlOTRjY2NhYmM4'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);

            dd($response);

            return $response;
        }
    }

    //call to spescific segment
//    $response = sendMessage();
//    $return["allresponses"] = $response;
//    $return = json_encode( $return);
//
//    print("\n\nJSON received:\n");
//    print($return);
//    print("\n");
//    //call to filtered people
//    $response = sendMessage();
//    $return["allresponses"] = $response;
//    $return = json_encode( $return);
//
//    print("\n\nJSON received:\n");
//    print($return);
//    print("\n");
//
?>
