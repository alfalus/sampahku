<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\models\Order;

use Auth;

class RewardController extends Controller
{
    public function index(){     
        $trx = $this->getJumlahTrx();   
        // $params = array(
        //     "q" => env("NEWS_QUERY"),
        //     "from" => date('Y-m-d', strtotime('-30 days')),
        //     "sortBy" => env("NEWS_SORT"),
        //     "apiKey" => env("NEWS_KEY")
        // );
        // $buildParam = http_build_query($params);
        // $urlNews = env('NEWS_URL').'/everything?'.$buildParam;
        // $client = new Client();

        // $response = $client->get($urlNews);
        // $resp = $response->getBody()->getContents();

        return view('reward')->with('trx',$trx);
    }

    public function getJumlahTrx()
    {
        try {
            $result = Order::where('id_penyetor','=',Auth::id())->where('status','=','2')->count();
        } catch (\Throwable $th) {
            dd($result);
        }

        return $result;
    }
}
