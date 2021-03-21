<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\InvalidClaimException;
use Tymon\JWTAuth\Exceptions\PayloadException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class AuthenticateJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {

            $username = auth()->payload()->get('usr');

            if(is_null($request->bearerToken()) or is_null($username) or empty($username)) {
                abort(401, 'You are unauthorized to view this endpoint.');
            }

            return $next($request);

        } catch (JWTException $e) {
            abort(401, $e->getMessage());
        } catch (InvalidClaimException $e) {
            abort(401, $e->getMessage());
        } catch (PayloadException $e) {
            abort(401, $e->getMessage());
        } catch (TokenBlacklistedException $e) {
            abort(401, $e->getMessage());
        } catch (TokenExpiredException $e) {
            abort(401, $e->getMessage());
        } catch (TokenInvalidException $e) {
            abort(401, $e->getMessage());
        } catch (UserNotDefinedException $e) {
            abort(401, $e->getMessage());
        }


    }
}
