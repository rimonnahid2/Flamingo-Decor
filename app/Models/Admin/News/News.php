<?php

namespace App\Models\Admin\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\News\Newscate;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Newscate()
    {
        return $this->belongsTo(Newscate::class);
    }
}
