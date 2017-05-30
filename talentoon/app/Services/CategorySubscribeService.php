<?php
namespace App\Services;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use DB;

class CategorySubscribeService
{

    public static function subscribe ($request){

    $subscribe = DB::table('subscribers')
    ->where('subscriber_id', '=', $request->subscriber_id)
    ->where('category_id', '=', $request->category_id)
    ->first();

if (is_null($subscribe)) {
    $subscribed=Subscriber::create($request->all());

} else {
    $is_subscribe=DB::table('subscribers')->where('subscriber_id',$request->subscriber_id)->update(['subscribed' => 1]);


}
return response()->json(['status' => 1,
                    'message' => 'Subscribed successfully']);


    }
    public static function unsubscribe ($request){
            $is_subscribe=DB::table('subscribers')->where('subscriber_id',$request->subscriber_id)->update(['subscribed' => 0]);

    return response()->json(['status' => 0,
                                'message' => 'UnSubscribed successfully']);

        }

}


?>
