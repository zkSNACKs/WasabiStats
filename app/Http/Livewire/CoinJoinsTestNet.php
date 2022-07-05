<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CJTest extends Component
{
    protected $listeners = ['refreshCjTestComponent' => '$refresh'];

    public function render()
    {
        try {
            $cjTest = Http::get('https://wasabiwallet.co/WabiSabi/human-monitor')->json()['roundStates'];
            $nodata = null;
        } catch (\Exception $th) {
            $nodata = 'No data from server!';
            $cjTest = null;
        }

        return view('livewire.cj-test',['cjTest' => $cjTest,'nodata' => $nodata]);
    }
}
