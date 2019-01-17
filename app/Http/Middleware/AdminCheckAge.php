<?php

namespace App\Http\Middleware;

use App\Common\Admin\AuthAdmin;
use Closure;

class AdminCheckAge
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
        $admin = session('admin');
        if(empty($admin)){
            return redirect('/admin/login');
        }
        $auth  =  new AuthAdmin();
        if( $auth->AuthAdmin($admin,$request->path())){
            return $next($request);
        }else{
           return redirect('admin/404');
        }
    }
}
