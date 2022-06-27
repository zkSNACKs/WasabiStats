<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HumanMonitor extends Component
{
    protected $listeners = ['refreshHumanMonitorComponent' => '$refresh'];

    public function render()
    {
        $humanMonitor = json_decode(file_get_contents('https://wasabiwallet.io/WabiSabi/human-monitor'))->roundStates;
        return view('livewire.human-monitor',['humanMonitor' => $humanMonitor]);
    }
}
