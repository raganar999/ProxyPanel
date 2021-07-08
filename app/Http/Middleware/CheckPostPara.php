<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;
use Log;
use Request;

class CheckPostPara
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
    	
    	
    	$validator = Validator::make(Request::header(),[
            'appkey'        => 'required',
            'device'        => 'required',
            'timestamp'     => 'required'
           
            
        ]);
           //  \Log::debug(Request::header());
         
        if ( $validator->fails() ){
            // return response()->json($validator->messages(), 422);
        	$response['error_code'] =  1003;
        	$response['message']    = 'missing parameters or errors';
        	// $response['message']    = '';
            $response['message_level']    = "toast";
		    return response()->json(['error' => $response]);

        }else{
    	
        return $next($request);
        
        }
    }
}
