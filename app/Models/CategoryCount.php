<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCount extends Model
{
    use HasFactory;
    protected $table = "category_counts";
    protected $fillable = ['category_id', 'total_count', 'daily_count', 'downloaded_at'];
    protected $dates = ['created_at', 'updated_at'];

    public function categories(){
        return $this->belongsTo(FileCategory::class,'category_id','id');
    }
}
