<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockSpam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next)
    {
        $ua = strtolower($request->userAgent());

        if (preg_match('/bot|spider|crawl|python|curl/i', $ua)) {
            abort(403);
        }

        $keywords = ['slot','casino','joker','หวย','เครดิตฟรี'];
        foreach ($keywords as $word) {
            if (str_contains($request->fullUrl(), $word)) {
                abort(403);
            }
        }
        return $next($request);
    }

}
