<?php

namespace App\Http\Controllers;

use App\Services\CoinService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CoinGeckoController extends Controller
{
    //
    protected $coinService;

    public function __construct(CoinService $coinService)
    {
        $this->coinService = $coinService;
    }

    public function listCoins()
    {

        return view('coin.index');
        // return response()->json($coins);
    }

    public function getCoin()
    {
        $coins = $this->coinService->getCoinList();
        $data = json_encode($coins);
        $data2 = json_decode($data);
        // dd($data2);
        return Datatables::of($data2)->make(true);
    }

    public function coinPrice(Request $request, $coinId)
    {
        $currency = $request->get('currency', 'usd');
        $price = $this->coinService->getCoinPrice($coinId, $currency);
        return response()->json($price);
    }

    public function listTrending()
    {
        // $coins = $this->coinService->getTrendingList();
        // $data = json_encode($coins);
        // $data2 = json_decode($data);
        // dd($data2->coins);
        return view('coin.trend');
    }

    public function getTrend()
    {
        $coins = $this->coinService->getTrendingList();
        $data = json_encode($coins);
        $data2 = json_decode($data);
        $data3 = $data2->coins;
        // dd($data2);
        return Datatables::of($data3)->make(true);
    }
}
