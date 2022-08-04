<?php

namespace App\Http\Livewire;

use App\Models\FileCategory;
use App\Models\Settings;
use Livewire\Component;

class SettingComponent extends Component
{
    public $version_id;
    public $from_date;

    public function setSetting()
    {
        $data = new Settings();
        $data->version_id = $this->version_id;
        $data->save();
        session()->flash('message','Successful saving!');
    }
    public function saveSettings()
    {
        $data = Settings::find(1);
        $data->version_id = $this->version_id;
        $data->save();
        session()->flash('message','Successful saving');
    }

    public function render()
    {
        $data = Settings::find(1);
        $categories = FileCategory::orderBy('published_at','DESC')->get();
        return view('livewire.setting-component',['data' => $data, 'categories' => $categories])->layout('layouts.base');
    }
}
