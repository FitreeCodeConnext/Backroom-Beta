<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class VendorGroupController extends Controller
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
                return view('pages.vendor_groups.index', compact('vendor_info'));
            } else {
                return redirect()->route('vendor')->withErrors(['error' => 'Api Data is Not Ready to use']);
            }
        } catch (RequestException $e) {
            $errorMessage = 'ไม่สามารถเชื่อมต่อกับ API ได้';
            Log::error($errorMessage . ' ' . $e->getMessage());
            return view('pages.vendor_groups.index', ['error' => $errorMessage]);
         }catch (\Exception $e) {
            $errorMessage = ' เกิดข้อผิดพลาดทางเซิร์ฟเวอร์ โปรดตรวจสอบการทำงานของเซิร์ฟเวอร์';
            Log::error($errorMessage . ' ' . $e->getMessage());
            return view('pages.vendor_groups.index', ['error' => $errorMessage]);
        }
    }  
    public function create(){
        return view('pages.vendor_groups.create');
    }
}
