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
            $nodata = null;
        } catch (\Exception $th) {
            $nodata = 'No data from server!';
            $cjMain = null;
        }
        return view('livewire.cjmain-component',['cjMain' => $cjMain,'nodata' => $nodata]);
    }
}
