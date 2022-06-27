<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

class HumanMonitor extends Component
{
    protected $listeners = ['refreshHumanMonitorComponent' => '$refresh'];

    public function render()
    {
        try {
            $humanMonitor = json_decode(file_get_contents('https://wasabiwallet.io/WabiSabi/human-monitor'))->roundStates;
            $nodata = null;
        } catch (\Throwable $th) {
            $humanMonitor = null;
            $nodata = 'No data from server!';
        }

        return view('livewire.human-monitor', ['nodata' => $nodata, 'humanMonitor' => $humanMonitor]);
    }
}
