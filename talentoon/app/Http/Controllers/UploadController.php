<?php

namespace App\Http\Controllers;

use App\Models\InitialReview;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ReviewMedia;
use App\Models\WorkShop;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Response;
use Session;
use App\Models\Upload;
use App\Models\Event;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadController extends Controller
{
    //
    public function uploded()
    {
        return view('/uploads/multiple');
    }

    public function store(Request $request)
    {
        $name = $request->input('image');
        return $name;
        //
    }

    public function multiple_upload(Request $request)
    {
        //getting all of the post data
        //            $files = $request->file('images');
        $files = Input::file('images');
//            dd($files);
        //Making counting of uploaded images
        $file_count = count($files);

        //start count how many uploaded
        $uploadcount = 0;

        foreach ($files as $file) {
            $rules = array('file' => 'required');//required|mimes:png,gif,jpeg,txt,pdf
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
            $destinationPath = 'uploads';// uploads folder in public directory
            $filename = $file->getClientOriginalName();
            $upload_success = $file->move($destinationPath, $filename);
            $uploadcount++;

            //save into database
            $extension = $file->getClientOriginalExtension();
            $entry = new Upload();
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $filename;
            $entry->filename = $file->getFilename() . '.' . $extension;
            $entry->save();
            dd('saved');
                }
        }

//        if ($uploadcount == $file_count) {
//            Session::flash('success', 'Upload successfully');
//            return Redirect::to('upload');
//        } else {
//            return Redirect::to('upload')->withInput()->withErrors($validator);
//        }

    }

    public function single_upload (Request $request,$id){
//        return response()->json(['id'=>";hhhhhhhhhhhhh"]);
//        return response()->json(['request'=> $_FILES['file'],'message' => 'data sent successfully']);
        if(!empty($_FILES)){
            $x = move_uploaded_file($_FILES['file']['tmp_name'],'uploads/files/'.$_FILES['file']['name']);

            $post = Post::find($id);
            $post->media_url = 'uploads/files/'.$_FILES['file']['name'];
            $post->media_type = $_FILES['file']['type'];
            $post->save();


            return response()->json(['request'=> $x,'message' => 'data sent successfully']);
        }else{
            echo "Image Is Empty";
        }

    }
    public function event_upload (Request $request,$id){
//        return response()->json(['id'=>"hhhhhhhhhhhhh"]);
//        return response()->json(['request'=> $_FILES['file'],'message' => 'data sent successfully']);
        if(!empty($_FILES)){

            $x = move_uploaded_file($_FILES['file']['tmp_name'],'uploads/files/'.$_FILES['file']['name']);
//            return response()->json(['id'=>$id]);
            $event =Event::find($id);
            $event->media_url = 'uploads/files/'.$_FILES['file']['name'];
            $event->media_type = $_FILES['file']['type'];
            $event->save();


            return response()->json(['request'=> $x,'message' => 'data sent successfully']);
        }else{
            echo "Image Is Empty";
        }

    }




    public function review_files_upload (Request $request,$category_talent_id){
        if(!empty($_FILES)){
            $count_of_files = count($_FILES['file']['tmp_name']);
            for($i=0;$i<$count_of_files;$i++){
                $x = move_uploaded_file($_FILES['file']['tmp_name'][$i],'uploads/reviews/'.$_FILES['file']['name'][$i]);

                $review_media = new ReviewMedia;
                $review_media->review_media_url = 'uploads/reviews/'.$_FILES['file']['name'][$i];
                $review_media->review_media_type = $_FILES['file']['type'][$i];
                $review_media->category_talent_id = $category_talent_id;
                $review_media->save();
            }

            return response()->json(['message' => 'files saved successfully',"Cattttttttttttttt" => $category_talent_id]);
        }else{
            echo "Image Is Empty";
        }

    }


    public function test(Request $request)
    {
        if(!empty($_FILES)){
            $rules = array('file' => 'mimes:png,gif,jpeg,jpg,txt,pdf');//required|mimes:png,gif,jpeg,txt,pdf
            $validator = Validator::make(array('file' => $_FILES['file']), $rules);
            if ($validator->passes()) {
                $destinationPath = 'uploads/files/' . $_FILES['file']['name'];// uploads folder in public directory
                $filename = $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $destinationPath);
                return response()->json(['request'=> '$','message' => 'data sent successfully']);
            }



            //save into database
//            $extension = $file->getClientOriginalExtension();
//            $entry = new Upload();
//            // $entry->mime = $file->getClientMimeType();
//            // $entry->original_filename = $filename;
//            $entry->filename = $file->getFilename() . '.' . $extension;
//            $images_ext = array('png','jpeg','jpg','gif');
//            $videos_ext = array('mp4','flv');
//            $files_ext  = array('txt','pdf');
//            $voice_ext  = array('mp3','aac');
//            if(in_array($extension,$image_ext)){
//                $entry->media_type='image';
//            }elseif (in_array($extension,$files_ext)) {
//                $entry->media_type='file';
//            }elseif (in_array($extension,$videos_ext)) {
//                $entry->media_type='vedio';
//            }elseif (in_array($extension,$voice_ext)){
//                $entry->media_type='audio';
//            }
//            $entry->media_source=$ally_htb3ato_nada;
//            $entry->source_id=$ally_htb3ato_nada;
//            $entry->save();
//            Session::flash('success', 'Upload successfully');
//            return Redirect::to('upload');
                }
        else{
            echo "Image Is Empty";
        }
        // }
        // if ($uploadcount == $file_count) {
        //
        // } else {
        //     return Redirect::to('upload')->withInput()->withErrors($validator);
        // }
    }
    public function workshop_upload (Request $request,$id){
//        return response()->json(['request'=> $_FILES['file'],'message' => 'data sent successfully']);
        if(!empty($_FILES)){
            $x = move_uploaded_file($_FILES['file']['tmp_name'],'uploads/files/'.$_FILES['file']['name']);

            $workshop = WorkShop::find($id);
            $workshop->media_url = 'uploads/files/'.$_FILES['file']['name'];
            $workshop->media_type = $_FILES['file']['type'];
            $workshop->save();


            return response()->json(['request'=> $x,'message' => 'data sent successfully']);
        }else{
            echo "Image Is Empty";
        }

    }
}
