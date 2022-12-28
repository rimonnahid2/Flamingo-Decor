<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Team;

class Teamcate extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Team()
    {
        return $this->hasMany(Team::class);
    }
}
