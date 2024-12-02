<?php
namespace App\Http\Clients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class NytClient {
    public function __construct(){
    }
    public function getBestSellers(array $params = []): Response
    {
        $key = config('services.nyt.key');
        $url = config('services.nyt.url') . '/lists/best-sellers/history.json';
        $params['api-key'] = $key;
        if(array_key_exists('isbn', $params) && sizeof($params['isbn'])){
            foreach($params['isbn'] as $key=>$isbn){
                $params['isbn'][$key] = str_replace('-','',$isbn);
            }
        }
        $response = Http::get($url, $params);
        return $response;
    }
}
