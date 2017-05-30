<?php
namespace App\Services;

    class Notification{
        //to all users
    function sendMessageAll(){
            $content = array(
                "en" => 'English Message'
            );

            $fields = array(
                'app_id' => "5e0081b4-a54d-46be-b6bb-a42fa5af576b",
                'included_segments' => array('All'),
                'data' => array("foo" => "bar"),
                'contents' => $content
            );

            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'));
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
                'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'));
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
            public function addDevice(){
                $fields = array(
                    'app_id' => "5e0081b4-a54d-46be-b6bb-a42fa5af576b",
                    'identifier' => "ce777617da7f548fe7a9ab6febb56cf39fba6d382000c0395666288d961ee566",
                    'language' => "en",
                    'timezone' => "-28800",
                    'game_version' => "1.0",
                    'device_os' => "9.1.3",
                    'device_type' => "0",
                    'device_model' => "iPhone 8,2",
                    'tags' => array("foo" => "bar")
                );

                $fields = json_encode($fields);
                print("\nJSON sent:\n");
                print($fields);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                $response = curl_exec($ch);
                curl_close($ch);

                $return["allresponses"] = $response;
                $return = json_encode( $return);

                print("\n\nJSON received:\n");
                print($return);
                print("\n");
            }



        //send based on filter like competitions
        function sendMessageFilter(){
            $content = array(
                "en" => 'English Message'
            );

            $fields = array(
                'app_id' => "5eb5a37e-b458-11e3-ac11-000c2940e62c",
                'filters' => array(array("field" => "tag", "key" => "level", "relation" => "=", "value" => "10"),array("operator" => "OR"),array("field" => "amount_spent", "relation" => "=", "value" => "0")),
                'data' => array("foo" => "bar"),
                'contents' => $content
            );

            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);

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
