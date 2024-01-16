<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimit
{
    public function __construct(private readonly RateLimiter $rateLimiter)
    {

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        if ($this->rateLimiter->tooManyAttempts( $ip, 5)) {
            return new JsonResponse(['error'=>'Too many Request'],429);
        }

        $this->rateLimiter->hit($ip);

        return $next($request);
    }
}
