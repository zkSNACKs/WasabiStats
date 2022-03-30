<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileCount extends Model
{
    use HasFactory;
    protected $table = "file_counts";
    protected $fillable = ['file_id', 'count', 'downloaded_at','daily_count','os'];
    protected $dates = ['created_at', 'updated_at'];

    public function files(){
        return $this->belongsTo(File::class,'file_id','id');
    }
}
