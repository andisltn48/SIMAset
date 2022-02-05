<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Roles;

use Illuminate\Support\Facades\Auth;
class CekVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::user()->email_verified_at != NULL) {
          return $next($request);
        } else {
          return redirect(route('email.verify.get'));
        }
    }
}
