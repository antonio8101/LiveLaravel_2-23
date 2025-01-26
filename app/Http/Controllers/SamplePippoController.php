<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SamplePippoController extends Controller
{
    public function get($id = null){
        return view('sample.form');
    }

    public function update(Request $request){
        return "PUT";
    }
}
