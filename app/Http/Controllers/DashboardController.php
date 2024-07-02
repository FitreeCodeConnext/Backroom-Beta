<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(){
        try {
            $api = Http::post(
                'http://10.10.1.7:9501/backroom/v1/dashboard',
                [
                    'branch_id' => '000972',
                    'user_id' => 'code'
                ]
            );
            $responseData = json_decode($api, true);
            $tender = $responseData['vw_tender_daily'];
    
            $data['payment_desc'] = " ";
            $data['total'] = " ";
    
            // dd($responseData);
    
            foreach ($tender as $key => $item) {
                if (!empty($item['payment_desc'])) {
                    $data['payment_desc'] .= "'" . $item['payment_desc'] . "',";
                    $data['total'] .= $item['total'] . ",";
                }
            }
            $groupedData = [];
            // dd($tender);
    
        foreach ($responseData['vw_terminal_daily'] as $item) {
            $branch_id = $item['branch_id'];
            $txntime = $item['txntime'];
    
            if (!isset($groupedData[$branch_id])) {
                $groupedData[$branch_id] = [];
            }
    
            if (!isset($groupedData[$branch_id][$txntime])) {
                $groupedData[$branch_id][$txntime] = [];
            }
    
            $groupedData[$branch_id][$txntime][] = $item;
        }
    
        $groupedData_format = [];
        foreach ($groupedData as $primary_branch => $tenders) {
            foreach ($tenders as $txntime => $transactions) {
                foreach ($transactions as $transaction) {
                    if (!isset($groupedData_format[$primary_branch])) {
                        if (empty($transaction['branch_name'])) {$transaction['branch_name'] = "";}
                        $groupedData_format[$primary_branch] = [
                            'branch_name' => $transaction['branch_name'],
                            'teminal_total' => $transaction['total'] ,
                        ];
                    } else {
                        $groupedData_format[$primary_branch]['branch_name'] = $transaction['branch_name'];
                        $groupedData_format[$primary_branch]['teminal_total'] .= $transaction['total'] . ',';
    
                    }
                }
            }
        }
            // dd($groupedData_format);
            return view('pages.dashboard', compact('data', 'groupedData_format' ));  
        }catch (RequestException $e) {
            $errorMessage = 'ไม่สามารถเชื่อมต่อกับ API ได้';
            Log::error($errorMessage . ' ' . $e->getMessage());
            return view('pages.dashboard', ['error' => $errorMessage]);
         }catch (\Exception $e) {
            $errorMessage = ' เกิดข้อผิดพลาดทางเซิร์ฟเวอร์ โปรดตรวจสอบการทำงานของเซิร์ฟเวอร์';
            Log::error($errorMessage . ' ' . $e->getMessage());
            return view('pages.dashboard', ['error' => $errorMessage]);
    }
    }
}
