<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost/api/test01/users/read.php',
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
            $i = 1;
        return view("pages.users.index",compact('data','i'));
    }

    public function create(){
        return view("pages.users.create");
    }
}
