<?php

namespace App\Services;

use GuzzleHttp\Client;

class CoinService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('COINGECKO_API_URL');
    }

    public function getCoinList()
    {
        $response = $this->client->get($this->baseUrl . 'coins/list');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getTrendingList()
    {
        $response = $this->client->get($this->baseUrl . 'search/trending');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getCoinPrice($coinId, $currency = 'usd')
    {
        $response = $this->client->get($this->baseUrl . 'simple/price', [
            'query' => [
                'ids' => $coinId,
                'vs_currencies' => $currency
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
