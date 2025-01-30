<?php

namespace Service\TradingFinance;

use DateInterval;
use Illuminate\Support\Facades\Cache;

class TradingFinanceInfoWithCache extends TradingFinanceInfo implements TradingFinanceInfoContract{

    private string $interval = '30 seconds';

    public function getDailyGainers( Market $market = Market::US ): array {

        $cacheKey = "getDailyGainers_result_" . $market->name;

        return $this->fromCache( $cacheKey, fn() => parent::getDailyGainers( $market ) );
    }

    public function getDailyLosers( Market $market = Market::US ): array {

        $cacheKey = "getDailyLosers_result". $market->name;

        return $this->fromCache( $cacheKey, fn() => parent::getDailyLosers( $market ) );
    }

    public function getDailyMostActive( Market $market = Market::US ): array {

        $cacheKey = "getMostActives_result". $market->name;

        return $this->fromCache( $cacheKey, fn() => parent::getDailyMostActive( $market ) );
    }

    public function getQuotes( Market $market, string ...$titles ): array {

        $cacheKey = "getQuotes_result". $market->name . "_" . implode(",", $titles);

        return $this->fromCache( $cacheKey, fn() => parent::getQuotes( $market, ...$titles ) );
    }

    private function fromCache(string $key, callable $callable){

        if ( ! Cache::has( $key ) ) {

            $result = $callable();

            $interval = DateInterval::createFromDateString( $this->interval );

            Cache::set( $key, $result, $interval);

        }

        return Cache::get( $key );
    }
}
