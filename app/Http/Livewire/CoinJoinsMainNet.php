<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CJMain extends Component
{
    protected $listeners = ['refreshCJMainComponent' => '$refresh'];

    public function render()
    {
        try {
            $cjMain = Http::get('https://wasabiwallet.io/WabiSabi/human-monitor')->json()['roundStates'];
            $nodata = null;
        } catch (\Exception $th) {
            $nodata = 'No data from server!';
            $cjMain = null;
        }

        return view('livewire.cj-main',['cjMain' => $cjMain,'nodata' => $nodata]);
    }
}
