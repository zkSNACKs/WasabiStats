<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';

    public function categories(){
        return $this->belongsTo(FileCategory::class,'version_id','id');
    }
}
