<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class TerminalController extends Controller
{
    public function index()
    {
        try {

            $sessions = session('auth_user');
            $api = Http::post(
                '10.10.1.7:9501/backroom/v1/terminal',
                [
                    'branch_id' => $sessions['branch_id'],
                    'user_id' => $sessions['user_id']
                ]
            );
    
            $api_response = json_decode($api->body(), true);
            $terminal_info = $api_response['terminal_info'];
            foreach ($terminal_info as $key => $value) {
    
                $terminal_id = $value['term_id'];
                $terminal_name = $value['term_name'];
                $branch_id = $value['branch_id'];
            }
    
            // dd($terminal_id);
    
            if (isset($api_response['Status'])) {
                return view('pages.terminals.index', compact('terminal_info'));
            } else {
                return redirect()->route('teminal')->withErrors(['error' => 'Api Data is Not Ready to use']);
            }
        } catch (RequestException $e) {
            $errorMessage = 'ไม่สามารถเชื่อมต่อกับ API ได้';
            Log::error($errorMessage . ' ' . $e->getMessage());
            return view('pages.terminals.index', ['error' => $errorMessage]);
         }catch (\Exception $e) {
            $errorMessage = ' เกิดข้อผิดพลาดทางเซิร์ฟเวอร์ โปรดตรวจสอบการทำงานของเซิร์ฟเวอร์';
            Log::error($errorMessage . ' ' . $e->getMessage());
            return view('pages.terminals.index', ['error' => $errorMessage]);
    }
        
    }

    public function create(){
        return view('pages.terminals.create');
    }

    public function store(Request $request){
        $data = [
            'branch_id' => $request->input('branch_id'),
            'term_name' => $request->input('term_name'),
            'pmino' => $request->input('pmino'),
            'serialno' => $request->input('serialno'),
            'ipaddress' => $request->input('ipaddress'),
            'activeflag' => $request->input('activeflag'),
            'slipprefix' => $request->input('slipprefix'),
            'file_address' => $request->input('file_address'),
            'download_flag' => $request->input('download_flag'),
            'download_date' => $request->input('download_date'),
        ];
        $terminal_function_group = [
            "equipment" => $request->input('equipment'),
            "type_equipment" =>$request->input('type_equipment'),
            "void_list" => $request->input('void_list'),
            "supervoid" => $request->input('supervoid'),
            "ip_check" => $request->input('ip_check'),
            "show_score" => $request->input('show_score'),
            "check_cardmoney" => $request->input('check_cardmoney'),
            "print_type" => $request->input('print_type'),
            "balance_enough" => $request->input('balance_enough'),
            "show_balance" => $request->input('show_balance'),
            "expire" => $request->input('expire'),

        ];

        dd($data,$terminal_function_group);
    }

    public function edit(Request $request)
    {
        $term_id = $request->terminal;
        $sessions = session('auth_user');
        $api = Http::post(
            '10.10.1.7:9501/backroom/v1/terminal',
            [
                'branch_id' => $sessions['branch_id'],
                'user_id' => $sessions['user_id'],
            ]
        );

        $api_response = json_decode($api->body(), true);

        $detail = $api_response['terminal_info'];

        $datagroup = [];
        $terminal_function_group = [];

        foreach ($detail as $key => $item) {
            $terminal_id = $item['term_id'];
            if (!isset($datagroup[$terminal_id])) {
                if ($terminal_id == $term_id) {
                    $datagroup[$term_id] = [
                        "term_id" => $item['term_id'],
                        "branch_id" => $item['branch_id'],
                        "term_name" => $item['term_name'],
                        "pmino" => $item['pmino'],
                        "serialno" => $item['serialno'],
                        "ipaddress" => $item['ipaddress'],
                        "activeflag" => $item['activeflag'],
                        "slipprefix" => $item['slipprefix'],
                        "file_address" => $item['file_address'],
                        "download_flag" => $item['download_flag'],
                        "download_date" => $item['download_date'],
                    ];
                    $headers = str_split($item['terminal_function']);
                    $terminal_function_group = [
                        "equipment" => $headers[0],
                        "type_equipment" => $headers[1],
                        "void_list" => $headers[2],
                        "supervoid" => $headers[3],
                        "ip_check" => $headers[4],
                        "show_score" => $headers[5],
                        "check_cardmoney" => $headers[6],
                        "print_type" => $headers[7],
                        "balance_enough" => $headers[8],
                        "show_balance" => $headers[9],
                        "expire" => $headers[10],

                    ];
                }
            }
        }


        // dd($headers,$terminal_function_group);
        if (isset($term_id)) {
            return view('pages.terminals.edit', compact('datagroup', 'term_id', 'terminal_function_group'));
        }
    }

    public function update(Request $request, $term_id)
    {
        $data = [
            'branch_id' => $request->input('branch_id'),
            'term_name' => $request->input('term_name'),
            'pmino' => $request->input('pmino'),
            'serialno' => $request->input('serialno'),
            'ipaddress' => $request->input('ipaddress'),
            'activeflag' => $request->input('activeflag'),
            'slipprefix' => $request->input('slipprefix'),
            'file_address' => $request->input('file_address'),
            'download_flag' => $request->input('download_flag'),
            'download_date' => $request->input('download_date'),
        ];

        $terminal_function_group = [
            'equipment' => $request->input('equipment'),
            'type_equipment' => $request->input('type_equipment'),
            'void_list' => $request->input('void_list'),
            'supervoid' => $request->input('supervoid'),
            'ip_check' => $request->input('ip_check'),
            'show_score' => $request->input('show_score'),
            'check_cardmoney' => $request->input('check_cardmoney'),
            'print_type' => $request->input('print_type'),
            'balance_enough' => $request->input('balance_enough'),
            'show_balance' => $request->input('show_balance'),
            'expire' => $request->input('expire'),
        ];

        $terminal_funtion = implode($terminal_function_group);
        // dd($term_id, $data,$terminal_funtion);

        $sessions = session('auth_user');

        $api = Http::post('10.10.1.7:9501/backroom/v1/terminal/update', [
            'branch_id' => $sessions['branch_id'],
            'user_id' => $sessions['user_id'],

            'terminal_data' => [
                'term_id' => $term_id,
                'branch_id' => $data['branch_id'],
                'term_name' => $data['term_name'],
                'pmino' => $data['pmino'],
                'serialno' => $data['serialno'],
                'ipaddress' => $data['ipaddress'],
                'terminal_function' => "$terminal_funtion",
                'activeflag' => $data['activeflag'],
                'file_address' => $data['file_address'],
                'download_flag' => $data['download_flag']

            ]
        ]);
        $term_data = null;

        if (isset($term_id,$api)) {
            $term_data = $api->json();
        }
        // dd($term_data['Status']);

        if (isset($term_data['Status'])) {
            return redirect()->route('terminal.index')->with('success', 'Terminal '. $term_id .' is Updated.');
        } else {
            return redirect()->route('terminal.index')->with('error', 'Terminal is Not Updated!!!');
        }
        // return response()->json($term_data);
    }
    public function destroy($id){
       $term_id = $id;
       dd($term_id);
    }

    public function export()
    {
        $sessions = session('auth_user');

        // Make the API request
        $api = Http::post('http://10.10.1.7:9501/backroom/v1/terminal', [
            'branch_id' => $sessions['branch_id'],
            'user_id' => $sessions['user_id']
        ]);

        // Check if API request was successful
        if ($api->successful()) {
            $api_response = $api->json();
            
            // Extract terminal_info from API response
            $data = $api_response['terminal_info'];

            // Prepare CSV data
            $csvData = [];
            foreach ($data as $item) {
                $csvData[] = [
                    'TERMINAL ID' => $item['term_id'],
                    'TERMINAL NAME' => $item['term_name'],
                    'BRANCH ID' => $item['branch_id'],
                    // Add more fields as necessary
                ];
            }

            // Generate CSV file
            $this->generateCsv($csvData, 'Terminal_Data');

            // Download the generated CSV file
            $csvFilePath = storage_path('app/public/Terminal_Data.csv');
            return response()->download($csvFilePath)->deleteFileAfterSend(true);
        } else {
            // Handle API request failure
            abort(500, 'Failed to fetch terminal data from API');
        }
    }

    private function generateCsv($csvData, $fileName)
    {
        $file = fopen(storage_path("app/public/{$fileName}.csv"), 'w');
        fputcsv($file, array_keys($csvData[0]));
        foreach ($csvData as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    }

    
}
