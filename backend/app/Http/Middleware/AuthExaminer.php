<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthExaminer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->user() && auth()->user()->role == 'examiner') {

            return $next($request);
        }



        return response()->json([
            'status' => 'error',
            'message' => 'Access Denied: Only Examiners Are Allowed'
        ], 403);
    }
}
