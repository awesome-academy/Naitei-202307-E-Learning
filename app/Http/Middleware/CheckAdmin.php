<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if (!(auth()->check())) {
            return redirect()->route('courses.index')
                ->with('error', __('Unauthorized'));
        }

        $role = auth()->user()->role;
        
        if ($role !== 'admin') {
            return redirect()->route('courses.index')
                ->with('error', __('Access denied'));
        }
        
        return $next($request);
    }
}
