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
        $urlToken = '';
        if(env('APP_ENV') == 'prod')
        {
            $urlToken = env('URL_TOKEN_PROD');
        }
        else if(env('APP_ENV') == 'dev')
        {
            $urlToken = env('URL_TOKEN_DEV');
        }

        try
        {
            $res = $client->request('POST',$urlToken, []);         
            $data = json_decode($res->getBody()->getContents());
            if(!isset($data->token))
            {
                return response()->json(['result'=>$res,'data'=>$data]);
            }
            return view('payment',['token'=> $data->token]);
        }catch(Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }
}
