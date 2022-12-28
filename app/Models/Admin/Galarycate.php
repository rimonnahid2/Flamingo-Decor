<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Galary;

class Galarycate extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Galary()
    {
        return $this->hasMany(Galary::class);
    }
}
