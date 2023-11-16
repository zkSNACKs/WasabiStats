<?php

namespace App\Console\Commands;

use App\Models\DailyBtcPrice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class StoreDailyBtcPriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:btcprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily store btc prices';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $startDate = strtotime(Carbon::create(2018, 1, 1));
        $endDate = strtotime(Carbon::now());
        $response = Http::get('https://api.coingecko.com/api/v3/coins/bitcoin/market_chart/range', [
            'vs_currency' => 'usd',
            'from' => $startDate,
            'to' => $endDate,
            'precision' => '02',
        ]);
        $data = $response->json();
        $prices = $data['prices'];

        foreach ($prices as $key => $price) {
            $timestampInMilliseconds = $price[0];
            $timestampInSeconds = $timestampInMilliseconds / 1000;
            $date = Carbon::createFromTimestamp($timestampInSeconds)->format('Y-m-d');
            if (!DailyBtcPrice::where('year_month_day', $date)->exists()) {
                DailyBtcPrice::create([
                    'year_month_day' => $date,
                    'price' => $price[1]
                ]);
            }
        }
        return true;
    }
}
