<?php

namespace App\Http\Controllers;

use App\Models\CategoryTalent;
use App\Models\InitialReview;
use App\Models\ReviewMedia;
use App\Models\Role;
use App\Models\User;
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
        $all_media_id = DB::table('initial_reviews')
            ->select('review_media_id')
            ->where("initial_reviews.mentor_id","!=",$mentor_id)
            ->get()->toArray();

        $arr=[];
        for ($i=0; $i <count($all_media_id) ; $i++) {
            array_push($arr,$all_media_id[$i]->review_media_id);
        }

        $all_media_iddddd = DB::table('initial_reviews')
            ->select('review_media_id')
            ->whereNotIn("initial_reviews.review_media_id",$arr)
            ->where("initial_reviews.mentor_id","=",$mentor_id)
            ->get()->toArray();

        //old of mina
//        $all_initial_posts = DB::table('category_talents')
//            ->join('review_media', 'category_talents.id', '=', 'review_media.category_talent_id')
//            ->join('users', 'category_talents.talent_id', '=', 'users.id')
//            ->join('categories', 'category_talents.category_id', '=', 'categories.id')
//            ->select('category_talents.*','review_media.*', 'categories.title as category_title','users.first_name', 'users.last_name', 'users.image')
//            ->whereIn("review_media.id", $arr)
//            ->get();

        $all_initial_posts = DB::select(DB::raw("Select DISTINCT users.first_name, users.image,categories.title as category_title,review_media.id as review_media_id ,review_media.*, review_media.category_talent_id as review_category_talent_id ,review_media.id as review_media_id , review_media.review_media_url,category_talents.id as category_talent_id , category_talents.* from category_talents join users on users.id = category_talents.talent_id join categories on category_talents.category_id = categories.id join review_media on review_media.category_talent_id = category_talents.id left join initial_reviews IR on IR.review_media_id = review_media.id where review_media.id not in (select initial_reviews.review_media_id from initial_reviews) OR IR.mentor_id not in (select IR.mentor_id from initial_reviews) or IR.mentor_id != $mentor_id "));
//        dd($all_initial_posts);

        return response()->json(['all_initial_posts' => $all_initial_posts,'status' => '1','message' => 'data sent successfully']);
    }

    public function store_single_review(Request $request)
    {
        InitialReview::create($request->all());

        //i need here to check if there is any more piece of work for the same talent id or not , if all his work has been reviewed please decide his level
        // and no need to wait 24 hours to decide his level according to the average points on all mentors

        $talent_id = $request->talent_id;

//        dd($talent_id);
        //select * from review_media JOIN initial_reviews on review_media.id = initial_reviews.review_media_id
        // join category_talents on category_talents.id = initial_reviews.category_talent_id
        // where category_talents.talent_id =6


//        $talent_media_remaining = DB::select(DB::raw("Select  review_media.id as review_media_id ,review_media.*, review_media.category_talent_id as review_category_talent_id ,review_media.id as review_media_id , review_media.review_media_url,category_talents.id as category_talent_id , category_talents.* from  category_talents join review_media on review_media.category_talent_id = category_talents.id where  review_media.id not in (select initial_reviews.review_media_id from initial_reviews)"));
//
//
//
//        $talent_media_remaining = DB::table('review_media')
//            ->join('initial_reviews','review_media.id', '=', 'initial_reviews.review_media_id')
//            ->join('category_talents','category_talents.id' ,'=' ,'initial_reviews.category_talent_id')
//            ->select('*')
//            ->where('category_talents.talent_id', $talent_id)
//            ->get();







        //level detection/////////////////////////////////////////////////////

        $level=0;
        $points=0;


        $total_mentor_reviews_points = DB::select(DB::raw("select  sum(initial_reviews.level_single) as points_level , initial_reviews.category_talent_id from `initial_reviews` where initial_reviews.category_talent_id = $request->category_talent_id  GROUP by initial_reviews.category_talent_id"));
        //user points
        if($total_mentor_reviews_points[0]->points_level) {
            $points = $total_mentor_reviews_points[0]->points_level;

            //level of user
            $level = 0;

            if ($points < 100) {
                $level = 1;
            }
            if ($points >= 100 && $points < 200) {
                $level = 2;
            }
            if ($points >= 200 && $points < 300) {
                $level = 3;
            }
            if ($points >= 300 && $points < 400) {
                $level = 4;
            }
            if ($points >= 400 && $points < 500) {
                $level = 5;
            }
            if ($points >= 500 && $points < 600) {
                $level = 6;
            }
            if ($points >= 600 && $points < 700) {
                $level = 7;
            }
            if ($points >= 700 && $points < 800) {
                $level = 8;
            }
            if ($points >= 800 && $points < 900) {
                $level = 9;
            }
            if ($points >= 900 && $points < 1000) {
                $level = 10;
            }


            //image of the reward
            switch ($level) {
                case "1":
                    $rewardimage = DB::table('rewards')
                        ->select('first')
                        ->get();
                    $levelname = "first";
                    break;
                case "2":
                    $rewardimage = DB::table('rewards')
                        ->select('second')
                        ->get();
                    $levelname = "second";
                    break;
                case "3":
                    $rewardimage = DB::table('rewards')
                        ->select('third')
                        ->get();
                    $levelname = "third";
                    break;
                case "4":
                    $rewardimage = DB::table('rewards')
                        ->select('fourth')
                        ->get();
                    $levelname = "fourth";
                    break;
                case "5":
                    $rewardimage = DB::table('rewards')
                        ->select('fifth')
                        ->get();
                    $levelname = "fifth";
                    break;
                case "6":
                    $rewardimage = DB::table('rewards')
                        ->select('sixth')
                        ->get();
                    $levelname = "sixth";
                    break;
                case "7":
                    $rewardimage = DB::table('rewards')
                        ->select('seventh')
                        ->get();
                    $levelname = "seventh";
                    break;
                case "8":
                    $rewardimage = DB::table('rewards')
                        ->select('eighths')
                        ->get();
                    $levelname = "eighths";
                    break;
                case "9":
                    $rewardimage = DB::table('rewards')
                        ->select('ninth')
                        ->get();
                    $levelname = "ninth";
                    break;
                case "10":
                    $rewardimage = DB::table('rewards')
                        ->select('tenth')
                        ->get();
                    $levelname = "tenth";
                    break;
                default:
                    $rewardimage = DB::table('rewards')
                        ->select('first')
                        ->get();
                    $levelname = "first";
                    break;
            }

            $rewardimage = $rewardimage[0]->$levelname;

        }
        //level detection ended///////////////////////////////////////////////////


        $category_talent = CategoryTalent::find($request->category_talent_id);
        $category_talent->status = '1';
        $category_talent->level = $level;
        $category_talent->save();




        DB::table('category_talents')->where('id', $request->category_talent_id )->update(['status' => 1]);
        $role = Role::where('name', '=','talent')->get()->first();
        $userId = DB::table('category_talents')
            ->join('users', 'users.id', '=', 'category_talents.talent_id')
            ->where('category_talents.id',$request->category_talent_id )
            ->select('users.id')
            ->first();
        $user=User::find($userId->id);
        try{
            $user->attachRole($role);
        }catch (\Exception $e){
            var_dump($e->errorInfo);
        }










//        $all_initial_posts = DB::table('category_talents')
//            ->join('review_media', 'category_talents.id', '=', 'review_media.category_talent_id')
//            ->join('users', 'category_talents.talent_id', '=', 'users.id')
//            ->join('categories', 'category_talents.category_id', '=', 'categories.id')
//            ->select('category_talents.*','review_media.*', 'categories.title as category_title','users.first_name', 'users.last_name', 'users.image')
//            ->whereIn("review_media.id", $arr)
//            ->get();




        return response()->json(['status' => '1','message' => 'review saved successfully']);
    }
}
