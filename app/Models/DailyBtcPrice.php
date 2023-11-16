<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyBtcPrice extends Model
{
    protected $table = 'dailybtcprice';
    use HasFactory;
    protected $fillable = [
        'year_month_day',
        'price'
    ];
}
