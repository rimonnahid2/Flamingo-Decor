<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\About;

class Aboutmore extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function About()
    {
        return $this->belongsTo(About::class);
    }
}
