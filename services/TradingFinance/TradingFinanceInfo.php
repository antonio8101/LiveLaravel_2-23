<?php

namespace Service\TradingFinance;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class TradingFinanceInfo implements TradingFinanceInfoContract {

    private string $host = "apidojo-yahoo-finance-v1.p.rapidapi.com";
    private string $rapidApiKey = "8887afb3e0msh94aba2b167f26d8p171807jsncdc623db3ea9";
    private string $baseUrl = 'https://apidojo-yahoo-finance-v1.p.rapidapi.com';

    public function getDailyGainers( Market $market = Market::US ) : array {

        return $this->getMovers( $market, Movers::Gainers );

    }

    public function getDailyLosers( Market $market = Market::US  ) : array {

        return $this->getMovers( $market, Movers::Losers );

    }

    public function getDailyMostActive( Market $market = Market::US  ) : array {

        return $this->getMovers( $market, Movers::MostActives );

    }

    public function getQuotes( Market $market, string ...$titles ) : array {

        $url = URL::format($this->baseUrl, 'market/v2/get-quotes');

        $headers = $this->getHeaders();

        $region = $market->name;

        $result = Http::withHeaders($headers)
                      ->withoutVerifying()
                      ->get($url,[
                          "region" => $region,
                          "symbols" => implode(",", $titles)
                      ]);

        if ($result->successful()){

            $rawQuotes = $result->object()->quoteResponse->result;

            return array_map(fn ($q) => $this->toTradingTitle($q), $rawQuotes);
        }

        return [];
    }

    private function getMovers( Market $market, Movers $movers ): array {

        $url = URL::format($this->baseUrl, 'market/v2/get-movers');
        $region = $market->name;
        $headers = $this->getHeaders();

        $result = Http::withHeaders($headers)
                      ->withoutVerifying()
                      ->get($url,[ "region" => $region ]);

        if ($result->successful()) {

            $records = $result->object()->finance->result;

            return $this->toResult($records, $market, $movers->value);

        }

        return  [];
    }

    private function toResult(array $rawRecords, Market $market, int $index) : array {

        if (array_key_exists( $index, $rawRecords )) {

            $meaningfulResults = $rawRecords[ $index ]->quotes;

            $symbols = array_map(fn ( $quote ) => $quote->symbol, $meaningfulResults);

            return $this->getQuotes($market, ...$symbols);
        }

        return [];
    }

    private function toTradingTitle( mixed $rawQuote ) : TradingQuote {

        $quote = new TradingQuote();

        $quote->symbol = $rawQuote->symbol;
        $quote->name = isset($rawQuote->longName) ? $rawQuote->longName : "";
        $quote->currency = $rawQuote->currency;
        $quote->fiftyTwoWeekRange = $rawQuote->fiftyTwoWeekRange;
        $quote->regularMarketDayHigh = $rawQuote->regularMarketDayHigh;
        $quote->regularMarketDayRange = $rawQuote->regularMarketDayRange;
        $quote->regularMarketPrice = $rawQuote->regularMarketPrice;
        $quote->regularMarketVolume = $rawQuote->regularMarketVolume;

        return $quote;
    }

    private function getHeaders(): array{
        return [
            "X-RapidAPI-Host" => $this->host,
            "X-RapidAPI-Key" => $this->rapidApiKey
        ];
    }
}
