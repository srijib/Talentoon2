<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Response;
use Illuminate\Http\Request;

use DOMDocument;
use  App\Http\Controllers\WizIQClass\AuthBase;
use  App\Http\Controllers\WizIQClass\AddTeacherClass;
use  App\Http\Controllers\WizIQClass\EditTeacherClass;




class VideoConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $categories= Category::all();
//        // $path=$categories[0]->getAttributes()['image'];
//        // $categories[5]->getAttributes()['image'] = '/uploads/files/'.$categories[5]->getAttributes()['image'];
//        // dd($categories[5]->getAttributes()['image']);
//        return response()->json(['data' => $categories,'status' => '1','message' => 'data sent successfully']);
//        // return view('categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // dd($request->all());
        // Category::create($request->all());
        // return Response::json(['status' => '1','message' => 'data saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $category=Category::find($id);
//        $posts=Post::where('category_id','=', $id)->get();
//        // dd($posts);
//        // dd(response()->json(['category_details' => $category,'posts' => $posts,'status' => '1','message' => 'data sent successfully']));
//        return response()->json(['category_details' => $category,'posts' => $posts,'status' => '1','message' => 'data sent successfully']);
        // return view('category.show',['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //may be front end don't want this method
        // $category=Post::find($categoryId);
        // return Response::json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Category::find($id)->update($request->all());
        // return Response::json($category);
        // return redirect()->route('admin.posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $category=Category::findOrFail($id);
        // $category->delete();
        // return Response::json($category);
        // return redirect()->route('admin.posts');
    }



    public function add_wiziq_teacher(Request $request)
    {
        $secretAcessKey = __secretAcessKey;
        $access_key=__access_key;
        $webServiceUrl = __webServiceUrl;

        //Nada This Code to add a new teacher with API
        //And get the response to be Teacher_ID
        //Teacher id in order to be used in any create class
        //Because our account is room based account.
        //require_once("AuthBase.php");
        $authBase = new AuthBase($secretAcessKey,$access_key);
        $method = "add_teacher";
        $requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
        $requestParameters["name"] = "Alyaa";
        $requestParameters["email"]="alyaa@alyaa.com";
        $requestParameters["password"]="123456";

        $httpRequest=new HttpRequest();
        try
        {
            $XMLReturn = $httpRequest->wiziq_do_post_request($webServiceUrl.'?method=add_teacher',http_build_query($requestParameters, '', '&'));
            $xml_cnt = $XMLReturn;
            $xml_cnt = str_replace(array("\n", "\r", "\t"), '', $xml_cnt);    // removes newlines, returns and tabs

            // replace double quotes with single quotes, to ensure the simple XML function can parse the XML
            $xml_cnt = trim(str_replace('"', "'", $xml_cnt));
            $simpleXml = simplexml_load_string($xml_cnt);
            echo json_encode($simpleXml);    // returns a string with JSON object
//            echo json_decode($simpleXml,true);
        }
        catch(Exception $e)
        {
            echo json_encode($e->getMessage());
        }
        //End Nada New Teacher API
    }





    public function create_wiziq_class(Request $request)
    {

        $secretAcessKey = __secretAcessKey;
        $access_key=__access_key;
        $webServiceUrl = __webServiceUrl;

//        require_once("AuthBase.php");
        $authBase = new AuthBase($secretAcessKey,$access_key);
        $method = "create";
        $requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
        #for teacher account pass parameter 'presenter_email'
        //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
        //this presenter email to your organization�s teacher account. � For more information visit at: (http://developer.wiziq.com/faqs)
        $requestParameters["presenter_email"]=$request->input('teacher_email');;
//      $requestParameters["presenter_email"]="kerrygun@gmail.com";
        #for room based account pass parameters 'presenter_id', 'presenter_name'
        $requestParameters["presenter_id"] = $request->input('teacher_id');
        $requestParameters["presenter_name"] = "Nada Bay";

        $requestParameters["start_time"] = "01/02/2018 12:11";
        $requestParameters["title"]="new Talentoon Course 1"; //Required
        $requestParameters["description"]="Talentoon Course 1 description"; //Required
        $requestParameters["duration"]="60"; //optional
        $requestParameters["time_zone"]="Africa/Cairo"; //optional
        $requestParameters["attendee_limit"]="10"; //optional
//        $requestParameters["control_category_id"]=""; //optional
        $requestParameters["create_recording"]="true"; //optional
//        $requestParameters["return_url"]=""; //optional
//        $requestParameters["status_ping_url"]=""; //optional
//        $requestParameters["language_culture_name"]="en-us";


        $httpRequest=new HttpRequest();
        try
        {
            $XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=create',http_build_query($requestParameters, '', '&'));

            //here find <recording_url> and find </recording_url>
            //to get url then give it as link to a button start class







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
                    $method=$methodTag->item(0)->nodeValue;
                    $class_idTag=$objDOM->getElementsByTagName("class_id");
                   $class_id=$class_idTag->item(0)->nodeValue;
                    $recording_urlTag=$objDOM->getElementsByTagName("recording_url");
                    $recording_url=$recording_urlTag->item(0)->nodeValue;
                    $presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
                    $presenter_email=$presenter_emailTag->item(0)->nodeValue;
                    $presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
                    $presenter_url=$presenter_urlTag->item(0)->nodeValue;


//                    $myObj=array();
                    $myObj["status"] = $attribNode;
                    $myObj["class_id"] = $class_id;
                    $myObj["recording_url"] = $recording_url;
                    $myObj["presenter_email"] =  $presenter_email;
                    $myObj["presenter_url"] = $presenter_url;
                    $myObj["start_time"] = $requestParameters["start_time"];
                    $myObj["duration"] = $requestParameters["duration"];
                    $myObj["attendee_limit"] = $requestParameters["attendee_limit"];

                    $myJSON = json_encode($myObj);

                    echo $myJSON;



                }
                else if($attribNode=="fail")
                {
                    $error=$objDOM->getElementsByTagName("error")->item(0);


                    $errorcode = $error->getAttribute("code");
                    $errormsg = $error->getAttribute("msg");

                    $myObj["status"] = $attribNode;
                    $myObj["errorcode"] = $errorcode;
                    $myObj["errormsg"]= $errormsg;

                    $myJSON = json_encode($myObj);
                    echo $myJSON;

                }
            }//end if









//            echo json_encode($XMLReturn);    // returns a string with JSON object
//
//            $xml_cnt = $XMLReturn;
//            $xml_cnt = str_replace(array("\n", "\r", "\t"), '', $xml_cnt);    // removes newlines, returns and tabs
//            // replace double quotes with single quotes, to ensure the simple XML function can parse the XML
//            $xml_cnt = trim(str_replace('"', "'", $xml_cnt));
//            $simpleXml = simplexml_load_string($xml_cnt);
//            echo json_encode($simpleXml);    // returns a string with JSON object
        }
        catch(Exception $e)
        {
            echo json_encode($e->getMessage());

        }
    }

}

class HttpRequest
{
    function wiziq_do_post_request($url, $data, $optional_headers = null)
    {
        $params = array('http' => array(
            'method' => 'POST',
            'content' => $data
        ));
        if ($optional_headers !== null)
        {
            $params['http']['header'] = $optional_headers;
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if (!$fp)
        {
            throw new Exception("Problem with $url, $php_errormsg");
        }
        $response = @stream_get_contents($fp);
        if ($response === false)
        {
            throw new Exception("Problem reading data from $url, $php_errormsg");
        }

        return $response;
    }
}//end class HttpRequest
