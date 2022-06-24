<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CloudFlareStat extends Component
{
    protected $listeners = ['refreshCloudFlareComponent' => '$refresh'];
    public function render()
    {
        $cloudFlareStatus = json_decode(file_get_contents('https://www.cloudflarestatus.com/api/v2/status.json'),true);

        return view('livewire.cloud-flare-stat',['cloudFlareStatus' => $cloudFlareStatus]);
    }
}
