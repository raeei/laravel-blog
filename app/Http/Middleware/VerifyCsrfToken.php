<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Auth;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
    
    // this code handles the 419 error page, 419 error due to mismatch token because session has expired
    public function handle($request, Closure $next) {
        if($request->route()->name('logout')) {
            if (!Auth::check() || Auth::guard()->viaRemember()){
                $this->except[] = route('logout');
            }
        }
        if($request->route()->name('login')) {
            if (!Auth::check() || Auth::guard()->viaRemember()){
                $this->except[] = route('login');
            }
        }
        return parent::handle($request, $next);
    }
}
