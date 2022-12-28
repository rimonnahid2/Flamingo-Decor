<?php

namespace App\Models\Admin\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\News\News;

class Newscate extends Model
{
    use HasFactory;
    protected $guarded = [];
     public function News()
    {
        return $this->hasMany(News::class);
    }
}
