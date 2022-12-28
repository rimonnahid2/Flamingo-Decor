<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Blog;

class Blogcate extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Blog()
    {
        return $this->hasMany(Blog::class);
    }
    
}
