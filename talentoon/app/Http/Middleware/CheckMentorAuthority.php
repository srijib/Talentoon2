<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Models\CategoryTalent;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;
use JWTAuth;

class CheckMentorAuthority extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request,Closure $next) {
     $user=JWTAuth::parseToken()->toUser();
     //dd($user);
            if (!$mentorrecord = DB::table('category_mentors')
                    ->where('mentor_id', $user->id)
                    ->where('category_id', $request->category_id)
                    ->first()
            ) {
                return response()->json(['status' => 'wrong', 'message' => 'unauthorized mentor'], 401);
            }
        
        return $next($request);
    }
}
