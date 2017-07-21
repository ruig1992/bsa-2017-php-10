<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class CheckCarAvailable
 * @package App\Http\Middleware
 */
class CheckCarAvailable
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
        if ($request->car->user_id !== Auth::user()->id) {
            abort(404, "This car isn't available for you. Try again!");
        }
        return $next($request);
    }
}
