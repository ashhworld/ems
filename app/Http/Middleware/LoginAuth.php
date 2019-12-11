<?php

namespace App\Http\Middleware;

use Closure;

class LoginAuth
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
        $has_supplied_credentials = (Session::get('user_name') && Session::get('password'));
          if ($has_supplied_credentials) {
               $rs_user = EmployeesModel::where('email_id', Session::get('user_name'))
                    ->where('password', md5(Session::get('password')))
                    ->first();

                    if ($rs_user) {
                        return $next($request);
                    }
          }

          return redirect()->guest('/');
    }
}
