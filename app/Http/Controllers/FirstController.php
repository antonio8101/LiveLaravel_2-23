<?php

namespace App\Http\Controllers;

use MyApp\RepositoryContract;

class FirstController extends Controller
{
    private string $param1;
    private array $p1;

    public function __construct(string $param1, RepositoryContract $repo, string ... $p1){
        $this->param1 = $param1;
        $this->p1 = $p1;
    }

    public function do(){

        dd($this->p1);

        return "->" . $this->param1;
    }
}
