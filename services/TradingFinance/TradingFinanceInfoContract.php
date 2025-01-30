<?php

namespace Service\TradingFinance;

interface TradingFinanceInfoContract {

    public function getDailyGainers( Market $market ) : array;
    public function getDailyLosers( Market $market ) : array;
    public function getDailyMostActive( Market $market ) : array;
    public function getQuotes( Market $market, string ...$symbols ) : array;

}
