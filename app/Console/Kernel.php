<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\DownloadData;
use App\Console\Commands\StoreDailyBtcPriceCommand;
use App\Console\Commands\StoreMonthlyBtcPriceCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
        /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        DownloadData::class,
        StoreDailyBtcPriceCommand::class,
        StoreMonthlyBtcPriceCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    /*protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //$schedule->command('download:wasabidata')->cron('* * * * * *');
        //$schedule->command('store:bitcoinprice')->cron('* * * * * *');
        //$schedule->command('store:monthlyprice')->cron('* * * * * *');
        //$schedule->call(DownloadData::class)->cron('* * * * * *');
    }*/

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
