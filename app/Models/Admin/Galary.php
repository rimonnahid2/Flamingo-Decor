<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Galarycate;

class Galary extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Galarycate()
    {
        return $this->belongsTo(Galarycate::class);
    }
}
