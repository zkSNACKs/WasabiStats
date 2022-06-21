<?php

namespace App\Console\Commands;

use App\Models\CategoryCount;
use App\Models\File;
use App\Models\FileCategory;
use App\Models\FileCount;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DownloadData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:wasabidata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download wasabi daily and total download count data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
        $date = Carbon::now()->format('Y-m-d');

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
                        if(str_contains($value['name'],'.msi') ||
                            str_contains($value['name'],'win7-x64')
                        )
                        {
                            $os = 'Windows';
                        }
                        if(str_contains($value['name'],'.dmg') ||
                            str_contains($value['name'],'macOS-x64') ||
                            str_contains($value['name'],'osx-x64')
                        )
                        {
                            $os = 'Mac';
                        }
                        if(str_contains($value['name'],'.tar.gz') ||
                            str_contains($value['name'],'linux-x64')
                        )
                        {
                            $os = 'Other Linux';
                        }
                        if(str_contains($value['name'],'arm64'))
                        {
                            $os = 'Mac M1';
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
                            $filecount->daily_count = $value['download_count'];
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
                    $categorycount->daily_count = $totalcount;
                }
                $categorycount->total_count = $totalcount;
                $categorycount->downloaded_at = $date;
                $categorycount->save();
            DB::commit();
        }
    }
}
