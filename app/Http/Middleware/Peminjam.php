<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Roles;

class Peminjam
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
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $role = Roles::where('id',$user->role_id)->first();

        if ($role->name == "Peminjam") {
            return $next($request);
          }
         return redirect('/')->with('error','Anda tidak dapat mengakses halaman ini');
    }
}
