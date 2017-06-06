<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Middleware\GetUserFromToken;


class RefreshedJWTAuth extends GetUserFromToken {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $response = $next($request);
        $expired = false;
        if (!$token = $this->auth->setRequest($request)->getToken()) {
            return $this->respond('tymon.jwt.absent', 'token_not_provided', 400);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            //return $this->respond('tymon.jwt.expired', 'token_expired', $e->getStatusCode(), [$e]);
            $expired = true;
        } catch (JWTException $e) {
            return $this->respond('tymon.jwt.invalid', 'token_invalid', $e->getStatusCode(), [$e]);
        }
        if ($expired) {
            try {
                $newToken = $this->auth->setRequest($request)->parseToken()->refresh();
                $user = $this->auth->authenticate($newToken);
                //dd("old token:",$token,"new token:",$newToken,"user:",$user);
            } catch (TokenExpiredException $e) {
                return $this->respond('tymon.jwt.expired', 'token_expired', $e->getStatusCode(), [$e]);
            } catch (JWTException $e) {
                return $this->respond('tymon.jwt.invalid', 'token_invalid', $e->getStatusCode(), [$e]);
            }
            // send the refreshed token back to the client
            //$request->headers->set('Authorization', 'Bearer ' . $newToken);
            //working
            //$request->headers->set('Authorization', 'Bearer ' . $newToken);
            //dd($response->header('Authorization', 'Bearer ' . $newToken));
            //not working
            $response->header('Authorization', 'Bearer ' . $newToken);
            //$response(csrf_token())->headers->set('Authorization', 'Bearer ' . $newToken);
        }

        if (!$user) {
            return $this->respond('tymon.jwt.user_not_found', 'user_not_found', 404);
        }

        $this->events->fire('tymon.jwt.valid', $user);

        //return $next($request);
        // return (new Response(csrf_token()))->header('Authorization', 'Bearer ' . $token->get());
        return $response;
    }

}
