<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next, $role)
  {
    $user = $request->user();
    if ($user->role != $role) {
      abort(403, 'User role does not match, your role is ' . $user->role . ' while the needed role is ' . $role);
    }
    return $next($request);
  }
}
