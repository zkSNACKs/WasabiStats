<?php

namespace App\Console\Commands;

use App\Models\DailyBtcPrice;
use App\Models\MonthlyBtcPrice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StoreMonthlyBtcPriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:monthlyprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store BTC monthly price';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $monthlyAverages = DailyBtcPrice::select(
            DB::raw('DATE_FORMAT(year_month_day, "%Y-%m") as month'),
            DB::raw('AVG(price) as average_price')
        )
        ->groupBy('month')
        ->get();
        foreach ($monthlyAverages as $month) {
            MonthlyBtcPrice::firstOrCreate(
                ['year_month' => $month->month],
                ['price' => $month->average_price]
            );
        }
        $currentMonth = now()->format('Y-m');
        $thisMonthAverage = DailyBtcPrice::select(
            DB::raw('DATE_FORMAT(year_month_day, "%Y-%m") as month'),
            DB::raw('AVG(price) as average_price')
        )
        ->where(DB::raw('DATE_FORMAT(year_month_day, "%Y-%m")'), $currentMonth)
        ->groupBy('month')
        ->first();
        if ($thisMonthAverage) {
            MonthlyBtcPrice::updateOrCreate(
                ['year_month' => $currentMonth],
                ['price' => $thisMonthAverage->average_price]
            );
        }
        return 0;
    }
}
