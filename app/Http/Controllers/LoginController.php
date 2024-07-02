<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        try {
            $api = Http::post(
                'http://10.10.1.7:9501/backroom/v1/branch',
                [
                    'branch_id' => '000972'
                ]
            );
            $response_data = json_decode($api, true);
            $data = array_diff_assoc($response_data);
            foreach ($data as  $value) {
                $data['branch_name'] = $value['branch_name'];
            }
            // dd($response_data);
            
                if(empty($data)){
                    $data['branch_name'] = "Empty";
                    return view('login', compact('data'));
                }else{
                    return view('login', compact('data'));
                }
        } catch (RequestException $e) {
            $errorMessage = 'ไม่สามารถเชื่อมต่อกับ API ได้';
            Log::error($errorMessage . ' ' . $e->getMessage());
        return view('login', ['error' => $errorMessage]);
    }catch (\Exception $e) {
            $errorMessage = ' เกิดข้อผิดพลาดทางเซิร์ฟเวอร์ โปรดตรวจสอบการทำงานของเซิร์ฟเวอร์';
            Log::error($errorMessage . ' ' . $e->getMessage());
            return view('login', ['error' => $errorMessage]);
    }
    }
    public function login(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Send an asynchronous POST request to the external API
        $apiResponse = Http::post('10.10.1.7:9501/backroom/v1/login', [
            'branch_id' => '000972',
            'user_id' => $username,
            'user_pass' => $password,
        ]);

        // Wait for the response
        $responseData = $apiResponse->json();
        
        if (isset($responseData['Status']) && $responseData['Status'] === '200') {
            $user_info = $responseData['user_info'][0];
            Session::put('auth_user', [
                'username' => $username,
                'user_name' => $user_info['user_name'],
            ]);

            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->withErrors(['error' => 'ไม่พบ Username หรือ Password ที่คุณป้อน']);
        }
    }
    public function logout()
    {
        Session::forget('auth_user');
        return redirect()->route('root');
    }
}
