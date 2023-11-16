<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyBtcPrice extends Model
{
    protected $table = 'monthlybtcprice';
    use HasFactory;
    protected $fillable = [
        'year_month',
        'price'
    ];
}
