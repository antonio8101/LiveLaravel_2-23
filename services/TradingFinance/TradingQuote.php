<?php

namespace Service\TradingFinance;

class TradingQuote {

    public string $symbol;
    public string $name;
    public string $currency;
    public float $regularMarketPrice;
    public float $regularMarketDayHigh;
    public string $regularMarketDayRange;
    public float $regularMarketVolume;
    public string $fiftyTwoWeekRange;

}
