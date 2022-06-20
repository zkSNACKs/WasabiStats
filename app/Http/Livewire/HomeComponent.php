<?php

namespace App\Http\Livewire;

use App\Models\CategoryCount;
use App\Models\File;
use App\Models\FileCategory;
use App\Models\FileCount;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeComponent extends Component
{
    public $files;
    public $data;
    public $from_date;
    public $to_date;
    public $type;
    public $cat;
    public $labels = [];
    public $datas = [];

    public function mount()
    {
        /*Set the default data show. to see the main page comment out the return row. */
        $fromdate = date(Carbon::now()->addMonths(-1)->format('Y-m-d'));
        $todate = date(Carbon::now()->format('Y-m-d'));
        return redirect(route('search',['id'=>34, 'from_date'=>$fromdate, 'to_date'=>$todate]));
    }

    public function storeData(){

        $url = 'https://api.github.com/repos/zkSNACKs/WalletWasabi/releases';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
              'User-Agent: request'
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        $date = Carbon::now()->addDays(-1)->format('Y-m-d');

        foreach($response as $resp)
        {
            DB::beginTransaction();
                $filecategory = FileCategory::firstOrCreate(
                    ['name' => $resp['name']],
                    ['published_at' => date_format(date_create($resp['published_at']),'Y-m-d')]
                );
                $totalcount = 0;
                foreach ($resp['assets'] as $value) {
                    if(!str_contains($value['name'],'.asc'))
                    {
                        $os = $value['name'];
                        if(str_contains($value['name'],'.deb'))
                        {
                            $os = 'Debian/Linux';
                        }
                        if(str_contains($value['name'],'.msi'))
                        {
                            $os = 'Windows';
                        }
                        if(str_contains($value['name'],'.dmg'))
                        {
                            $os = 'Mac';
                        }
                        if(str_contains($value['name'],'.tar.gz'))
                        {
                            $os = 'Other Linux';
                        }
                        if(str_contains($value['name'],'win7-x64'))
                        {
                            $os = 'Win7-x64.zip';
                        }
                        if(str_contains($value['name'],'linux-x64'))
                        {
                            $os = 'Linux-x64.zip';
                        }
                        if(str_contains($value['name'],'osx-x64'))
                        {
                            $os = 'Mac(osx)-x64.zip';
                        }

                        $file = File::firstOrCreate(
                            ['name' => $value['name']],
                            ['category_id' => $filecategory->id]
                        );
                        $file->os = $os;
                        $file->save();
                        $filecount = new FileCount();
                        $filecount->file_id = $file->id;
                        $filecount->count = $value['download_count'];
                        $totalcount += $value['download_count'];
                        $prevday = FileCount::where('file_id',$file->id)->orderBy('downloaded_at','DESC')->first();

                        if($prevday != ""){
                            $filecount->daily_count = $value['download_count'] - $prevday->count;
                        }
                        else{
                            $filecount->daily_count = 0;
                        }
                        $filecount->downloaded_at = $date;
                        $filecount->save();
                    }
                }
                $categorycount = new CategoryCount();
                $categorycount->category_id = $filecategory->id;
                $prevdaycat = CategoryCount::where('category_id',$filecategory->id)->orderBy('downloaded_at','DESC')->first();
                if($prevdaycat != ""){
                    $categorycount->daily_count = $totalcount - $prevdaycat->total_count;
                }
                else{
                    $categorycount->daily_count = 0;
                }
                $categorycount->total_count = $totalcount;
                $categorycount->downloaded_at = $date;
                $categorycount->save();
            DB::commit();
            session()->flash('message',' Sikeresen letöltve!');
        }

    }

    public function render()
    {
        return view('livewire.home-component')->layout('layouts.base');
    }
}
