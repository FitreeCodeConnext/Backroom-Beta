<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductUnitController extends Controller
{
    public function index(){
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

        return view("pages.product_units.index" ,compact("data"));
    }
    public function create(){
        return view("pages.product_units.create");
    }
    
    public function store(Request $request){
        $unit_id = $request->input("unitid");
        $unit_name = $request->input("unitname");
        $unit_check = $request->input("unitcheck");
        dd($unit_id,$unit_name,$unit_check);
    }
}
