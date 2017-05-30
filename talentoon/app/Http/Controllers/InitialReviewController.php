<?php

namespace App\Http\Controllers;

use App\Models\InitialReview;
use App\Models\ReviewMedia;
use DB;

use Illuminate\Http\Request;

class InitialReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $initialreviews = InitialReview::all();
        return response()->json(['data' => $initialreviews,'status' => '1','message' => 'data sent successfully']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = '{"mentor_initial_review":[{"category_talent_id":"1","category_mentor_id":"1","review_media_id":"1","points":"2","comment":"no comment one"},{"category_talent_id":"1","category_mentor_id":"2","review_media_id":"8","points":"2","comment":"no comment two"},{"category_talent_id":"1","category_mentor_id":"1","review_media_id":"9","points":"3","comment":"no comment three"}]}';
        // $mentor_initial_review = (array)json_decode($data,true);

        $mentor_initial_review = $mentor_initial_review['mentor_initial_review'];

        for($index=0;$index<count($mentor_initial_review);$index++){

            $review = DB::table('initial_reviews')
                ->select('initial_reviews.*')
                ->where("initial_reviews.category_talent_id",$mentor_initial_review[$index]['category_talent_id'])
                ->where("initial_reviews.category_mentor_id",$mentor_initial_review[$index]['category_mentor_id'])
                ->where("initial_reviews.review_media_id",$mentor_initial_review[$index]['review_media_id'])
                ->get();


            if(count($review)==0){

                $initial_review = new InitialReview();
                //$initial_review->category_talent_id = Auth::user()->id;
                $initial_review->category_talent_id = $mentor_initial_review[$index]['category_talent_id'];
                $initial_review->category_mentor_id = $mentor_initial_review[$index]['category_mentor_id'];
                $initial_review->review_media_id = $mentor_initial_review[$index]['review_media_id'];
                $initial_review->points = $mentor_initial_review[$index]['points'];
                $initial_review->comment = $mentor_initial_review[$index]['comment'];
                $initial_review->save();
            }

        }

        return response()->json(['status' => '1','message' => 'data saved successfully']);



    }


    public function store_talent_initial_review_media()
    {

        $data = '{"initial_review_files":[{"category_talent_id":1,"review_media_type":"image","review_media_url":"nada.jpg"},{"category_talent_id":1,"review_media_type":"image","review_media_url":"nada2.jpg"},{"category_talent_id":1,"review_media_type":"image","review_media_url":"nada3.jpg"}]}';
        $initial_review_files = (array)json_decode($data,true);

        $initial_review_files = $initial_review_files['initial_review_files'];

        for($index=0;$index<count($initial_review_files);$index++){
            $review_media = new ReviewMedia();
            //$review_media->category_talent_id = Auth::user()->id;
            $review_media->category_talent_id = $initial_review_files[$index]['category_talent_id'];
            $review_media->review_media_type = $initial_review_files[$index]['review_media_type'];
            $review_media->review_media_url = $initial_review_files[$index]['review_media_url'];
            $review_media->save();
        }
        return response()->json(['status' => '1','message' => 'data saved successfully']);
    }

//
//    public function myFunction($a){
//        $$a+=2;
//    }
//

    public function get_media_for_initial_review(Request $request,$category_talent_id,$category_mentor_id)
    {

//        $b = 1;
//        myFunction($b);
//
//        dd($b);
////        $i = 5;
//        $y = 'j';
//        dd($y.$i);
        //SELECT * , users.* FROM `initial_reviews`
        // join review_media on initial_reviews.review_media_id = review_media.id
        // join category_talents on category_talents.talent_id = review_media.category_talent_id
        // join users on users.id = category_talents.talent_id

        $media_for_review = DB::table('initial_reviews')
            ->join('review_media', 'initial_reviews.review_media_id', '=', 'review_media.id')
            ->join('category_talents', 'category_talents.talent_id', '=', 'review_media.category_talent_id')
            ->join('users', 'users.id', '=', 'category_talents.talent_id')

            ->select('initial_reviews.*', 'users.*')
            ->where("initial_reviews.category_talent_id",$category_talent_id)
            ->where("initial_reviews.category_mentor_id",$category_mentor_id)
            ->get();


        return response()->json(['media_for_initial_review' => $media_for_review,'status' => '1','message' => 'data sent successfully']);


    }







    /**
     * Display the specified resource.
     *
     * @param  \App\InitialReview  $initialReview
     * @return \Illuminate\Http\Response
     */
    public function show(InitialReview $initialReview)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InitialReview  $initialReview
     * @return \Illuminate\Http\Response
     */
    public function edit(InitialReview $initialReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InitialReview  $initialReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InitialReview $initialReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InitialReview  $initialReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(InitialReview $initialReview)
    {
        //
    }

    public function show_not_reviewed_initial_posts(Request $request,$mentor_id)
    {
        $all_media_id=InitialReview::select("review_media_id")->get();
        $arr=[];
        for ($i=0; $i <count($all_media_id) ; $i++) {
            array_push($arr,$all_media_id[$i]['review_media_id']);
        }
        $all_initial_posts = DB::table('category_talents')
            ->join('review_media', 'category_talents.id', '=', 'review_media.category_talent_id')
            ->join('users', 'category_talents.talent_id', '=', 'users.id')
            ->join('categories', 'category_talents.category_id', '=', 'categories.id')
            ->join('initial_reviews', 'category_talents.id', '=', 'initial_reviews.category_talent_id')
            ->select('category_talents.*','review_media.*', 'categories.title as category_title', 'users.first_name', 'users.last_name', 'users.image')
            ->whereNotIn("review_media.id", $arr)
            ->where("initial_reviews.mentor_id","!=",$mentor_id)
            ->get();
        return response()->json(['all_initial_posts' => $all_initial_posts,'status' => '1','message' => 'data sent successfully']);
    }

    public function store_single_review(Request $request)
    {
        InitialReview::create($request->all());
        return response()->json(['status' => '1','message' => 'review saved successfully']);
    }
}
