<?php

namespace App\Http\Controllers;

use App\RepositoryPattern\RepoInterface;
use Illuminate\Http\Request;

class TestController2 extends Controller
{
    protected $test;
     function __construct(RepoInterface $test)
    {
        $this->test = $test;
    }

    public function test()
    {
        return $this->test->sayHello();
    }
}
