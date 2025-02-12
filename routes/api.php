<?php

use App\Http\Middleware\AddPropToRequest;
use App\Models\Film;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Service\TradingFinance\Market;
use Service\TradingFinance\TradingFinanceInfoFacade;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('trading')->group(function(){

    //Route::get('trading/gainers/{market}',
    //    fn ( Market $market, TradingFinanceInfoContract $service ) => $service->getDailyGainers( $market )
    //);
    //Route::get('trading/losers/{market}',
    //    fn ( Market $market, TradingFinanceInfoContract $service ) => $service->getDailyLosers( $market )
    //);
    //Route::get('trading/actives/{market}',
    //    fn ( Market $market, TradingFinanceInfoContract $service ) => $service->getDailyMostActive( $market )
    //);
    //Route::get('trading/quotes/{market}/{quote}',
    //    fn ( Market $market, string $quote, TradingFinanceInfoContract $service ) => $service->getQuotes( $market, $quote )
    //);

    Route::get('/trading/gainers/{market}', fn( Market $market ) => view('trading.gainers', [ 'market' => TradingFinanceInfoFacade::getDailyGainers( $market ) ] ) );
    Route::get('/trading/losers/{market}', fn( Market $market ) => TradingFinanceInfoFacade::getDailyLosers( $market ) );
    Route::get('/trading/actives/{market}', fn( Market $market ) => TradingFinanceInfoFacade::getMostActives( $market ) );
    Route::get('/trading/quotes/{market}/{quote}', fn( Market $market, string $quote ) => TradingFinanceInfoFacade::getQuotes( $market, $quote ) );
});

Route::prefix('posts')->group(function(){
    Route::get('/', function () {
        return DB::table('posts')->get()->take(3);
    } );
});

Route::prefix('sakila')->group(function(){
    Route::get('/film', function () {

        $queryBuilder =
            Film::query()->with('actors')
                ->where('title', 'like', '%a%')
                ->where(function ($queryBuilder) {
                      $queryBuilder->where('length', '>=', 50)
                                   ->orWhereNot('rating', 'NC-17');
                })
                ->whereHas('actors', function ($queryBuilder) {
                    $queryBuilder->where('first_name', 'Nick');
                })
                ->orderBy('film.film_id', 'desc')
                ->withTrashed();

        Log::info( "SQL QUERY: " . $queryBuilder->toSql() );

        return $queryBuilder->get()->take(3);
    } );

    Route::get('/film/{id}', function ($id) {
        $film = Film::find($id);

        return $film;
    });

    Route::any('/film/search', function (Request $request) {

        if($request->isMethod('get')) {
            return view('sakila.film.search');
        }
        else {
            $query = $request->input('query');
            $films = Film::query()->where('title', 'like', "%$query%")->get();
            return view('sakila.film.search', compact('films'));
        }

    });


    Route::post('/film', function (Request $request) {

//        $film = new Film();
//        $film->title = $request->title;
//        $film->save();

        Film::create([
            "title" => $request->title
        ]);

        return 1;
    });

    Route::post('/film/{id}', function (Request $request, $id) {

        $film = Film::find($id);
        $film->title = $request->title;
        $film->save();

        return 1;
    });

    Route::delete('/film/{id}', function ($id) {
        Film::destroy($id);
    });
});

Route::get('/headers/show', function (Request $request) {

    if (! $request->expectsJson())
        throw new \Exception("Not expecting JSON");

    return "test" ;
})->middleware('auth:sanctum');


Route::post('/request/all', function (Request $request) {
    return $request->all();
});

Route::post('/request/input', function (Request $request) {
    return $request->input();
});

Route::post('/request/query', function (Request $request) {
    return $request->query();
});

Route::post('/request/json', function (Request $request) {
    return $request->input('input1.name');
});

Route::post('/request/json/viaprop', function (Request $request) {
    $request->input2;
    return $request->input1["name"];
});

Route::post('/request/merge', function (Request $request) {
    return $request->all();
})->middleware(AddPropToRequest::class);

Route::post('/request/cookie', function (Request $request) {
    return $request->cookie('Cookie_2');
});

Route::post('/request/file/upload', function (Request $request) {
    if($request->hasFile('file'))
        return $request->file('file')
                       ->store('images', [
                           'disk' => 'public'
                       ]);
    else
        return "No file";
});

Route::get('/request/file/download', function (Request $request) {
    $file = Storage::disk('public')
                   ->path('images/HwtwMzOpnezyXWgsLJXEnaEffkFKUXGB8quxd2Z2.jpg');

    return response()
        ->download($file);
});

Route::get('/request/file/view', function (Request $request) {
    $file = Storage::disk('public')
                   ->path('images/HwtwMzOpnezyXWgsLJXEnaEffkFKUXGB8quxd2Z2.jpg');

    return response()
        ->file($file);
});

Route::post('/login', function (Request $request) {
    if(Auth::attempt([
        "email" => $request->username,
        "password" => $request->password
    ])){
        return Auth::user()->createToken('token')->plainTextToken;
    }
});


Route::post('/post/update/request-authorize/{post}', function (Request $request, Post $post) {

    if($request->user()->cannot('update', $post)) {
        abort( 403 );
    }

    $post->title = $request->title;
    $post->save();

    return $post;
})->middleware('auth:sanctum');

Route::post('/post/update/gate-authorize/{post}', function (Request $request, Post $post) {

    Gate::authorize('update', $post);

    if($request->user()->cannot('update', $post)) {
        abort( 403 );
    }

    $post->title = $request->title;
    $post->save();

    return $post;
})->middleware('auth:sanctum');

Route::post('/post/update/gate-allows/{post}', function (Request $request, Post $post) {

    if ( ! Gate::allows('update-post', $post)) {
        abort( 403 );
    }

    $post->title = $request->title;
    $post->save();

    return $post;
})->middleware('auth:sanctum');
