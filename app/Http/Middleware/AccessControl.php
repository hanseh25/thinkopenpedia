<?php
namespace Shine\Http\Middleware;

use Closure, Cache, Session;

class AccessControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $module)
    {
        if (Cache::has('roles')) {
            $val = Cache::get('roles');
            
            if (isset($val['modules'][$module]) || $val['role_name'] == 'Developer') // for dev edition only
            {
                return $next($request);
            }
            else 
            {
                Session::flash('warning', 'You are not authorized to access the page.');
                return redirect('dashboard');
            }
        }
    }
}
