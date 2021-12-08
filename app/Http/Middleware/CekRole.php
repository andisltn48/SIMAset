<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Roles;

use Illuminate\Support\Facades\Auth;
class CekRole
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
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $role = Roles::where('id',$user->role_id)->first();
        foreach ($roles as $key => $value) {
            if ($role->name == $value) {    
                // dd($role->name);
                return $next($request);
            }
        }
         return redirect('/')->with('error',"Anda tidak dapat mengakses halaman ini");
    }
}
