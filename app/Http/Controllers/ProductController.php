<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(Request $request){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost/api/test01/product/read.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            $data = json_decode($response, true);
            // dd($data);

            $i = 1;
        
       
        return view("pages.products.index",compact('data','i'));
    }

    public function create(){
        return view("pages.products.create");
    }

    
}
