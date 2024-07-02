<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;


class VendorController extends Controller
{
    public function index()
    {
        try {
            $api = Http::post(
                '10.10.1.7:9501/backroom/v1/vendor',
                [
                    'branch_id' => '000972',
                    'user_id' => 'code'
                ]
            );
    
            $api_response = json_decode($api->body(), true);
            $vendor_info = $api_response['vendor_info'];
            foreach ($vendor_info as $key => $value) {
    
                $vendor_id = $value['vendor_id'];
                $vendor_name = $value['vendor_name'];
                $vendorno = $value['vendorno'];
            }
    
            // dd($vendor_info);
    
            if (isset($api_response['Status'])) {
                return view('pages.vendor', compact('vendor_info'));
            } else {
                return redirect()->route('vendor')->withErrors(['error' => 'Api Data is Not Ready to use']);
            }
        } catch (RequestException $e) {
            $errorMessage = 'ไม่สามารถเชื่อมต่อกับ API ได้';
            Log::error($errorMessage . ' ' . $e->getMessage());
            return view('pages.vendor', ['error' => $errorMessage]);
         }catch (\Exception $e) {
            $errorMessage = ' เกิดข้อผิดพลาดทางเซิร์ฟเวอร์ โปรดตรวจสอบการทำงานของเซิร์ฟเวอร์';
            Log::error($errorMessage . ' ' . $e->getMessage());
            return view('pages.vendor', ['error' => $errorMessage]);
    }
    }

    public function show(Request $request){
        $vendor_id = $request->vendor_id;
        $api = Http::post(
            '10.10.1.7:9501/backroom/v1/vendor',
            [
                'branch_id' => '000972',
                'user_id' => 'code'
            ]
        );
        $api_response = json_decode($api->body(), true);
        $detail = $api_response['vendor_info'];
        $datagroup = [];
        foreach($detail as $key => $item){
            $ven_id = $item['vendor_id'];
            if (!isset($datagroup[$ven_id])) {
                if($ven_id == $vendor_id){
                    $datagroup[$ven_id] = [
                        'vendor_id' => $item['vendor_id'],
                        'branch_id' => $item['branch_id'],
                        'term_id' => $item['term_id'],
                        'term_seq' => $item['term_seq'],
                        'vendor_name' => $item['vendor_name'],
                        'vendor_food' => $item['vendor_food'],
                        'vendorno' => $item['vendorno'],
                        'productno' => $item['productno'],
                        'pmino' => $item['pmino'],
                        'serialno' => $item['serialno'],
                        'ipaddress' => $item['ipaddress'],
                        'forrent' => $item['forrent'],
                        'gprate_1' => $item['gprate_1'],
                        'gprate_2' => $item['gprate_2'],
                        'gprate_3' => $item['gprate_3'],
                        'vatrate' => $item['vatrate'],
                        'govvatrate' => $item['govvatrate'],
                        'includevat' => $item['includevat'],
                        'includegovvat' => $item['includegovvat'],
                        'invoiceprint' => $item['invoiceprint'],
                        'invoicename' => $item['invoicename'],
                        'invoiceaddr1' => $item['invoiceaddr1'],
                        'invoiceaddr2' => $item['invoiceaddr2'],
                        'invoiceduedate' => $item['invoiceduedate'],
                        'invoicepaydate' => $item['invoicepaydate'],
                        'typediscount' => $item['typediscount'],
                        'discountamt' => $item['discountamt'],
                        'cur_discount' => $item['cur_discount'],
                        'def_discount' => $item['def_discount'],
                        'use_discount' => $item['use_discount'],
                        'discount_bdate' => $item['discount_bdate'],
                        'discount_edate' => $item['discount_edate'],
                        'discount_btime' => $item['discount_btime'],
                        'discount_etime' => $item['discount_etime'],
                        'vendor_function' => $item['vendor_function'],
                        'txnno' => $item['txnno'],
                        'vendor_batchno' => $item['vendor_batchno'],
                        'issuedate' => $item['issuedate'],
                        'activeflag' => $item['activeflag'],
                        'min_garantee1' => $item['min_garantee1'],
                        'min_garantee2' => $item['min_garantee2'],
                        'min_garantee3' => $item['min_garantee3'],
                        'dis_garantee' => $item['dis_garantee'],
                        'validdate' => $item['validdate'],
                        'vendor_subfood' =>  $item['vendor_subfood'],
                        'taxbranch' => $item['taxbranch'],
                        'vendor_locate' => $item['vendor_locate'],
                        'vendor_paymenttype' => $item['vendor_paymenttype'],
                        'billcount' => $item['billcount'],
                        'owner_shop' => $item['owner_shop'],
                        'ar_sap' => $item['ar_sap'],
                        'costcenter' => $item['costcenter'],
                        'invoicecontractname' => $item['invoicecontractname'],
                        'vendor_area' => $item['vendor_area'],

                    ];
                }
            }
        }

        // dd($datagroup);
        if (isset($vendor_id)) {
           return view('pages.vendordetail',compact('vendor_id','datagroup'));
        }
    }
}
