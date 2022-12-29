<?php
namespace App\Http\Middleware;
use Closure;
class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (! \Auth::user()->hasRole('admin')) 
            return response(trans('backpack::base.unauthorized'),401);
        return $next($request);
    }
}