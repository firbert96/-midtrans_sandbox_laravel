<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getPayment()
    {
        $client = new Client();
        try
        {
            $res = $client->request('POST',env('URL_TOKEN'), []);
            $data = json_decode($res->getBody()->getContents());
            return view('payment',['token'=> $data->token]);
        }catch(Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }
}
