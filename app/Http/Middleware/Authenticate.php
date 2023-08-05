<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (\Illuminate\Support\Facades\Request::is(app()->getLocale() . '/student/dashboard')) {
                return route('selection');
            }
            elseif(\Illuminate\Support\Facades\Request::is(app()->getLocale() . '/teacher/dashboard')) {
                return route('selection');
            }
            elseif(\Illuminate\Support\Facades\Request::is(app()->getLocale() . '/parent/dashboard')) {
                return route('selection');
            }

        }
    }
}
