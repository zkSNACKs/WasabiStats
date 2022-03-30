<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileCategory extends Model
{
    use HasFactory;
    protected $table = 'file_categories';
    protected $fillable = ['name', 'published_at'];
    protected $dates = ['created_at', 'updated_at'];

    public function files(){
        return $this->hasMany(File::class);
    }
}
