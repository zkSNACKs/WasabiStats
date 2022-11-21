<?php

namespace App\Http\Livewire;

// use App\Http\Resources\ChartViewResource;
use App\Models\CategoryCount;
use App\Models\File;
use App\Models\FileCategory;
use App\Models\FileCount;
// use App\Models\FreshCoin;
// use App\Models\MonthlyCoinJoin;
// use App\Models\MonthlyVolumes;
use Carbon\Carbon;
use Livewire\Component;

class ChartComponent extends Component
{
    public $labes = [];
    public $dats = [];
    public $name = [];
    public $category_id;
    public $from_date;
    public $to_date;
    public $piedata = [];
    public $piename = [];
    public $freshdate = [];
    public $freshwasabi = [];
    public $freshsamuri = [];
    public $freshotheri = [];
    public $monthlydate = [];
    public $monthlywasabi = [];
    public $monthlysamuri = [];
    public $monthlyotheri = [];
    public $monthlyjoindate = [];
    public $monthlyjoinwasabi = [];
    public $monthlyjoinsamuri = [];
    public $total;
    public $totalsearchdate;
    public $daily;
    public $nodata;
    public $bardata = [];
    public $barname = [];
    public $barpublished = [];
    public $stackeddaydata = [];
    public $stackedweekdata = [];
    public $stackedweekdatashow = [];
    public $stackedname = [];
    public $stackedpublished = [];

    public function mount($id=4, $from_date, $to_date){

        $this->category_id = $id;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $datas = CategoryCount::where('category_id',$id)
            ->whereBetween('downloaded_at', [date($this->from_date),date($this->to_date)])
            ->get();
        if(isset($datas[0]))
        {
            $this->name = $datas[0]->categories->name.': from: '.$this->from_date.' to: '.$this->to_date;
            $this->totalsearchdate = 0;
            foreach($datas as $data){
                array_push($this->labes,$data->downloaded_at);
                array_push($this->dats,$data->daily_count);
                $this->total = $data->total_count;
                $this->daily = $data->daily_count;
                $this->totalsearchdate += $data->daily_count;
            }
            $files = File::where('category_id',$id)->get();
            foreach($files as $file)
            {
                $downloadeddate = Carbon::now()->addDays(-1)->format('Y-m-d');
                $counts = FileCount::where('file_id',$file->id)
                    ->orderBy('downloaded_at','DESC')
                    ->get();
                $name = $counts[0]->files->os;
                $filecount = 0;
                    foreach($counts as $count)
                    {
                        $filecount += $count->count;
                    }
                if(!in_array($name, $this->piename))
                {
                    array_push($this->piedata,$filecount);
                    array_push($this->piename,$name);
                }
                if(in_array($name, $this->piename))
                {
                    foreach($this->piename as $k=> $piename)
                    {
                        if($piename == $name)
                        {
                            $this->piedata[$k] += $filecount;
                        }
                    }
                }
            }
            $totalpiedata = 0;
            foreach($this->piedata as $data)
            {
                $totalpiedata += $data;
            }
            if($totalpiedata != 0)
            {
                foreach($this->piedata as $key => $v)
                {
                    $this->piedata[$key] = round($v/$totalpiedata*100,2);
                }
            }
            foreach($this->piename as $key => $v)
            {
                if (!str_contains($v,'.wasabisig')) {
                    $this->piename[$key] = $v.': '.$this->piedata[$key].'%';
                }
                if (str_contains($v,'.wasabisig')) {
                    unset($this->piename[$key]);
                }

            }

            $totaldownloads = CategoryCount::with('categories')
                ->where('downloaded_at',$downloadeddate)
                ->get()
                ->sortBy('categories.published_at',SORT_REGULAR,false);

            foreach ($totaldownloads as $key => $value) {
                if(!str_contains($value->categories->name, 'TestNet'))
                {
                    array_push($this->bardata,$value->total_count);
                    array_push($this->barname,$value->categories->name);
                    array_push($this->barpublished,$value->categories->published_at);
                }
            }

            $firstdate = CategoryCount::first()->downloaded_at;
            $categoryCounts = FileCategory::with('count')->where('published_at','>=',$firstdate)
                ->where('name', 'NOT LIKE', "%TestNet%")
                ->get();
            foreach($categoryCounts as $count)
            {
                array_push($this->stackedname,$count->count[0]->categories->name);
                array_push($this->stackedpublished,$count->count[0]->categories->published_at);
                array_push($this->stackeddaydata,$count->count[0]->total_count);
                if(isset($count->count[6]))
                {
                    array_push($this->stackedweekdata,$count->count[6]->total_count);
                    array_push($this->stackedweekdatashow,($count->count[6]->total_count)-$count->count[0]->total_count);
                }
                else {
                    array_push($this->stackedweekdata,$count->count[count($count->count)-1]->total_count);
                    array_push($this->stackedweekdatashow,($count->count[count($count->count)-1]->total_count)-$count->count[0]->total_count);
                }
            }

            /* $freshcoins = FreshCoin::all();
            foreach ($freshcoins as $key => $freshcoin) {
                array_push($this->freshdate,$freshcoin->date);
                array_push($this->freshwasabi,$freshcoin->wasabi);
                array_push($this->freshsamuri,$freshcoin->samuri);
                array_push($this->freshotheri,$freshcoin->otheri);
            }
            $monthlyvolumes = MonthlyVolumes::all();
            foreach ($monthlyvolumes as $key => $monthlyvolume) {
                array_push($this->monthlydate,$monthlyvolume->date);
                array_push($this->monthlywasabi,$monthlyvolume->wasabi);
                array_push($this->monthlysamuri,$monthlyvolume->samuri);
                array_push($this->monthlyotheri,$monthlyvolume->otheri);
            }
            $monthlycoinjoins = MonthlyCoinJoin::all();
            foreach ($monthlycoinjoins as $key => $monthlycoinjoin) {
                array_push($this->monthlyjoindate,$monthlycoinjoin->date);
                array_push($this->monthlyjoinwasabi,$monthlycoinjoin->wasabi);
                array_push($this->monthlyjoinsamuri,$monthlycoinjoin->samuri);
            }*/
        }
        else{
            $this->nodata = 'No relevant data! Please check the search conditions!';
        }
    }
    public function render()
    {
        $category = FileCategory::find($this->category_id);
        return view('livewire.chart-component', ['category' => $category])->layout('layouts.base');
    }
}
