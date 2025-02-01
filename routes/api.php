<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Service\TradingFinance\Market;
use Service\TradingFinance\TradingFinanceInfoContract;
use Service\TradingFinance\TradingFinanceInfoFacade;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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
