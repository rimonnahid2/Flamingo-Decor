<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;
use App\Models\Admin\Subcate;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

     public function Product()
    {
        return $this->hasMany(Product::class);
    }

     public function Subcate()
    {
        return $this->hasMany(Subcate::class);
    }
}
