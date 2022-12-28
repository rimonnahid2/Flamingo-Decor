<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Blogcate;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Blogcate()
    {
        return $this->belongsTo(Blogcate::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
