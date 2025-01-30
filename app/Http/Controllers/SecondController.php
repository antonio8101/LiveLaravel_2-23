<?php

namespace App\Http\Controllers;

use MyApp\RepositoryContract;

class SecondController extends Controller
{
    private string $param1;

    public function __construct(string $param1, RepositoryContract $repo){
        $this->param1 = $param1;
    }

    public function do(){
        return "->" . $this->param1;
    }
}
