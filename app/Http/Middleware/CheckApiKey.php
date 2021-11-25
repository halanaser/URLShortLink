<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CheckApiKey
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

        $key = $request->header('x-api-key');
      
        if ($key !== config('app.Api_key')) {
        
            
            return Response::json([
                'message' => 'Invalid API Key',
            ], 400);
        }
        return $next($request);
        
        
       
    }
}
