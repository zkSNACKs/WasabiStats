<?php

namespace App\Http\Livewire;

use App\Models\CategoryCount;
use App\Models\FileCategory;
use Livewire\Component;

class SearchComponent extends Component
{
    public $files;
    public $from_date;
    public $to_date;
    public $cat;
    public $labels = [];
    public $datas = [];
    public $total;
    public $totalsearchdate;
    public $daily;

    public function mount($total=null, $totalsearchdate=null, $daily=null, $id=null, $from_date=null, $to_date=null)
    {
        $this->total = $total;
        $this->totalsearchdate = $totalsearchdate;
        $this->daily = $daily;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->cat = $id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'from_date' => 'required',
            'to_date' => 'required',
            'cat' => 'required'
        ]);
    }

    public function searchCount(){

        $this->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'cat' => 'required'
        ]);
        return redirect(route('search',['id'=>$this->cat, 'from_date'=>$this->from_date, 'to_date'=>$this->to_date]));
    }

    public function render()
    {
        $mindate = CategoryCount::orderBy('downloaded_at', 'ASC')->first();
        $categories = FileCategory::orderBy('published_at','DESC')->get();
        return view('livewire.search-component',['categories' => $categories, 'mindate' => $mindate]);
    }
}
