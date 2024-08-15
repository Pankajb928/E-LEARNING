<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use App\Services\JWTService;

class CheckJwtToken
{
    protected $jwtService;

    public function __construct(JWTService $jwtService)
    {
        $this->jwtService = $jwtService;
    }
    public function handle($request, Closure $next)
    {
        try{
            $user = $this->jwtService->tokenDecode($request->header('token'));
            if(isset($user) && $user->email != ''){
            }
            else{
                return response()->json(['status' => 'Unauthorised User Please Login again'], 401);
            }
        }
       catch (Exception $e) {
                return response()->json(['status' => 'Unauthorized User Pleae login Again'], 401);
        }
        return $next($request);
    }
}

