<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Aboutmore;

class About extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function Aboutmore()
    {
        return $this->hasMany(Aboutmore::class);
    }
}
