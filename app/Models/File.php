<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = "files";
    protected $fillable = ['name', 'category_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function count(){
        return $this->hasMany(FileCount::class);
    }
    public function category(){
        return $this->belongsTo(FileCategory::class);
    }
}
