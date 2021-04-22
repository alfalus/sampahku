<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RewardController extends Controller
{
    public function index(){        
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

        return view('reward');
    }
}
