<?php

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
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
        return Film::find($id);
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
