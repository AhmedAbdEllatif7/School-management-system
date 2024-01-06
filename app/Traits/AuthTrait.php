<?php

namespace App\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function checkGuard($type){

        if($type == 'student'){
            $guardName= 'student';
        }
        elseif ($type == 'parent'){
            $guardName= 'parent';
        }
        elseif ($type == 'teacher'){
            $guardName= 'teacher';
        }
        else{
            $guardName= 'web';
        }
        return $guardName;
    }

    public function redirect($type){

        if($type == 'student'){
            return redirect()->intended(RouteServiceProvider::STUDENT);
        }
        elseif ($type == 'parent'){
            return redirect()->intended(RouteServiceProvider::PARENT);
        }
        elseif ($type == 'teacher'){
            return redirect()->intended(RouteServiceProvider::TEACHER);
        }
        else{
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
