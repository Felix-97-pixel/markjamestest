<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class ExternalApiController extends Controller
{
    public function index()
    {
        $client = new Client();
        $responseListTable = $client->request('GET', 'https://test.drogueriahofmann.cl/usuarios/ListTableUsers');
        $responseGetUsers = $client->request('GET', 'https://test.drogueriahofmann.cl/usuarios/GetUsers');

        if ($responseListTable->getStatusCode() == 200 && $responseGetUsers->getStatusCode() == 200) {
            $dataGetUsers = json_decode($responseGetUsers->getBody()->getContents(), true);
            $dataListTable = json_decode($responseListTable->getBody()->getContents(), true);

            $nameMap = [];
            foreach ($dataGetUsers as $item) {
                $nameMap[$item['code']] = $item['name'];
            }
            $data = [];
            foreach ($dataListTable as $item) {
                $code = $item['code'];
                if (isset($nameMap[$code])) {
                    $item['name'] = $nameMap[$code];
                }
                
                // Formatear la fecha de cada item
                $item['date'] = Carbon::parse($item['date'])->format('Y-m-d');

                $data[] = $item;
            }
        } else {
            $data = [];
        }

        return view('externalapi.index', compact('data'));
    }

    public function update(Request $request){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://test.drogueriahofmann.cl/usuarios/SendUser', [
            'json' => [
                'id' => $request->id,
                'code' => $request->code,
                'amount' => $request->amount,
                'date' => Carbon::parse($request->date)->toIso8601String(),
                'github' => $request->github
            ]
        ]);

        dd($response->getStatusCode());
        
    }
}