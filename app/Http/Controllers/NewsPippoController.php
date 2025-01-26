<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsCategory;

class NewsPippoController extends Controller
{
    public function index(Request $request){
        return view('news.list',["filter"=>""]);
    }

    public function get(Request $request, $id){
        return view('news.detail', [
            "news_id" => $id
        ]);
    }

    public function filter(Request $request, NewsCategory $filter){
        return view( 'news.list', [ "filter" => $filter->value ] );
    }
}
