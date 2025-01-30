<?php

namespace Service\TradingFinance;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getDailyGainers( Market $market )
 * @method static getDailyLosers( Market $market )
 * @method static getMostActives( Market $market )
 * @method static getQuotes( Market $market, string $quote )
 */
class TradingFinanceInfoFacade extends Facade  {

    protected static function getFacadeAccessor() {

        return TradingFinanceInfoContract::class;

    }

}
