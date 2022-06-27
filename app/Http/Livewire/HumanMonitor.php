<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class HumanMonitor extends Component
{
    protected $listeners = ['refreshHumanMonitorComponent' => '$refresh'];

    public function render()
    {
        try {
            $humanMonitor = Http::get('https://wasabiwallet.io/WabiSabi/human-monitor')->json()['roundStates'];
            $nodata = null;
        } catch (\Exception $th) {
            $nodata = 'No data from server!';
            $humanMonitor = null;
        }

        return view('livewire.human-monitor',['humanMonitor' => $humanMonitor,'nodata' => $nodata]);
    }
}
