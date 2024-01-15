<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CjmainComponent extends Component
{
    protected $listeners = ['refreshCoinJoinsMainNetComponent' => '$refresh'];

    public function render()
    {
        try {
            $cjMain = Http::get('https://wasabiwallet.io/WabiSabi/human-monitor')->json()['roundStates'];
            $statusUrl = 'https://wasabiwallet.io/WabiSabi/status';

            $headers = [
                'Accept: application/json',
                'Content-Type: application/json-patch+json',
            ];
            foreach ($cjMain as $key => $value) {
                $roundId = $value['roundId'];
                $data = [
                    'roundCheckpoints' => [
                        [
                            'roundId' => $roundId,
                            'stateId' => 0,
                        ],
                    ],
                ];

                $ch = curl_init($statusUrl);

                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $response = curl_exec($ch);

                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                }
                curl_close($ch);
                if(isset(json_decode($response, true)['roundStates']))
                {
                    $filtered = array_filter(json_decode($response, true)['roundStates'], function ($object) use ($roundId) {
                        return $object['id'] === $roundId;
                    });
                    $keys = array_keys($filtered);
                    if (isset($keys[0])) {
                        $cjMain[$key]['allowedInputAmounts'] = $filtered[$keys[0]]['coinjoinState']['events'][0]['roundParameters']['allowedInputAmounts'];
                    }
                }
            }
            $nodata = null;
        } catch (\Exception $th) {
            $nodata = 'No data from server!';
            $cjMain = null;
        }
        return view('livewire.cjmain-component',['cjMain' => $cjMain,'nodata' => $nodata]);
    }
}
